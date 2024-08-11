<?php
namespace App\Http\Controllers\User;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\HotelCoupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderPackageDetails;
use App\Models\Package;
use App\Models\PhonePeOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Http;
class OrderController extends Controller
{
    public function __construct()
    {
    }
    public function createOrder($amount = 0,$order=null,$email=null,$mobile=null)
    {
        $paymentData = [
            'merchantId' => env('PHONEPE_MERCHANT_ID'),
            'merchantTransactionId' => $order['trans_id'],
            'amount' => ($amount * 100),
            'merchantUserId' => 'MUID'.$order['user_id'],
            'redirectUrl' => url('api/phone_redirect_url'),
            'redirectMode' => 'POST',
            'callbackUrl' => url('api/phone_redirect_url'),
            'merchantOrderId' =>  $order['order_id'],
            'mobileNumber' => $mobile,
            'paymentInstrument'=>array('type'=>'PAY_PAGE'),
        ];
        $json_payload = json_encode($paymentData);
        $payloadMain = base64_encode($json_payload);
        $keyIndex =1;
        $payload = $payloadMain."/pg/v1/pay".env('PHONEPE_MERCHANT_SECRET_KEY');
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256.'###'.$keyIndex;
        $request = json_encode(array('request'=>$payloadMain));
        $ch = curl_init('https://api.phonepe.com/apis/hermes/pg/v1/pay');
        // $ch = curl_init('https://api.phonepe.com/apis/hermes/pg/v1/pay');
        $headers = [
            'Content-Type: application/json',
            'X-VERIFY: '.$final_x_header,
            "accept:application/json",
        ];
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($response);
        $payUrl = '';
        if(isset($res->success) && $res->success == 1)
        {
            $payUrl = $res->data->instrumentResponse->redirectInfo->url;
        }
        return $payUrl;
    }
    private function generateXVerifyHeader($payload)
    {
        $data = json_encode($payload);
        $salt = env('PHONEPE_MERCHANT_SECRET_KEY');
        $checksum = hash('sha256', $data . $salt);
        return $checksum . '###' . env('PHONEPE_MERCHANT_ID');
    }
    public function orderPlace(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $auth = Auth::user();
            $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->get();
            $post_amount = 1;
            // foreach($cart as $key => $value)
            // {
            //     $post_amount+=$value->amount;
            // }
            $amount = 0;
            $order['order_id'] = orderCode();
            $order['user_id'] = Auth::guard('customer')->user()->id;
            $order['amount'] = $amount;
            $order['trans_id'] = "txn_" . rand(111111, 999999);
            $order['type'] = 'package';
            $order['user_name'] = $auth->name;
            $order['user_email'] = $auth->email;
            $order['user_phone'] = $auth->mobile;
            if($request->payment_method == 'phone_pay')
            {
                $return_response=$this->createOrder($post_amount,$order,$auth->email,$auth->mobile);
                $response['success'] = true;
                $response['payUrl'] = $return_response;
                $phonepe_orders = new PhonePeOrders();
                $phonepe_orders->customer_id = Auth::guard('customer')->user()->id;
                $phonepe_orders->amount = $post_amount;
                $phonepe_orders->order_id = $order['order_id'];
                $phonepe_orders->transaction_id = $order['trans_id'];
                $phonepe_orders->save();
                return response()->json($response, 200);
            }
            $order_create = Order::create($order);
            foreach ($cart as $key => $value) {
                $amount += $value->amount;
                $order = [];
                $orderItems = [];
                if ($value->type == 'package') {
                    $record = Package::where('id', $value->coupon_id)->with(['PackageItem'])->first();
                    if ($record->type == 'single') {
                        if ($order_create->id) {
                            foreach ($record->PackageItem as $key => $val) {
                                $coupon_data = Coupon::where('id', $val->coupon_id)->first();
                                $hotel_data = Hotel::where('id', $val->hotel_id)->first();
                                $orderItems['order_id'] = $order_create->id;
                                $orderItems['coupon_id'] = $val->coupon_id;
                                $orderItems['hotel_id'] = $val->hotel_id;
                                $orderItems['coupon'] = $coupon_data->custom_coupon_id;
                                $orderItems['category_id'] = $coupon_data->category_id;
                                $orderItems['package_id'] = $record->id;
                                $orderItems['type'] = 'Package';
                                $orderItems['coupon_data'] = json_encode($coupon_data);
                                $orderItems['hotel_data'] = json_encode($hotel_data);
                                $orderItems['valid_date'] = Carbon::now()->addYears(5);
                                $orderItems['visit_type'] = $coupon_data->visit_type;
                                $orderItems['mobile_number'] = $auth->mobile;
                                $order_details_create = OrderDetails::create($orderItems);
                            }
                            $update_to_package = [];
                            $order_package_details = [];
                            $order_package_details['order_id'] = $order_create->id;
                            $order_package_details['package_id'] = $record->id;
                            $order_package_details['package_log'] = json_encode($record->toarray());
                            $order_package_details['hotel_id'] = $hotel_data->id;
                            $order_package_details['hotel_log'] = json_encode($hotel_data->toarray());
                            OrderPackageDetails::create($order_package_details);
                            $update_to_package['limit'] = $record->limit - 1;
                            $update_to_package['sold_count'] = $record->sold_count + 1;
                            Package::where('id', $record->id)->update($update_to_package);
                        } else {
                            $success = true;
                            $message = __('api.order.fail');
                            $response['success'] = $success;
                            $response['message'] = $message;
                            $response['data'] = $data;
                            return response()->json($response, 200);
                        }
                    } else {
                        if ($order_create->id) {
                            $hotal_array = [];
                            foreach ($record->PackageItem as $key => $val) {
                                $coupon_data = Coupon::where('id', $val->coupon_id)->first();
                                $hotel_data = Hotel::where('id', $val->hotel_id)->first();
                                $orderItems['order_id'] = $order_create->id;
                                $orderItems['coupon_id'] = $val->coupon_id;
                                $orderItems['hotel_id'] = $val->hotel_id;
                                $orderItems['coupon'] = $coupon_data->custom_coupon_id;
                                $orderItems['category_id'] = $coupon_data->category_id;
                                $orderItems['coupon_data'] = json_encode($coupon_data);
                                $orderItems['hotel_data'] = json_encode($hotel_data);
                                $orderItems['valid_date'] = Carbon::now()->addYears(5);
                                $orderItems['visit_type'] = $coupon_data->visit_type;
                                $orderItems['mobile_number'] = $auth->mobile;
                                $orderItems['package_id'] = $record->id;
                                $orderItems['type'] = 'Package';
                                $order_details_create = OrderDetails::create($orderItems);
                                // add order packag detaisl
                                if (! in_array($hotel_data->id, $hotal_array)) {
                                    array_push($hotal_array, $hotel_data->id);
                                    $order_package_details = [];
                                    $order_package_details['order_id'] = $order_create->id;
                                    $order_package_details['package_id'] = $record->id;
                                    $order_package_details['package_log'] = json_encode($record->toarray());
                                    $order_package_details['hotel_id'] = $hotel_data->id;
                                    $order_package_details['hotel_log'] = json_encode($hotel_data->toarray());
                                    OrderPackageDetails::create($order_package_details);
                                }
                            }
                            $update_to_package = [];
                            $update_to_package['limit'] = $record->limit - 1;
                            $update_to_package['sold_count'] = $record->sold_count + 1;
                            Package::where('id', $record->id)->update($update_to_package);
                        } else {
                            $success = true;
                            $message = __('api.order.fail');
                            $response['success'] = $success;
                            $response['message'] = $message;
                            $response['data'] = $data;
                            return response()->json($response, 200);
                        }
                    }
                } elseif ($value->type == 'coupon') {

                    $record = HotelCoupon::where('id', $value->coupon_id)->first();
                    // $order['order_id'] = orderCode();
                    // $order['user_id'] = Auth::guard('customer')->user()->id;
                    // $order['amount'] = $amount;
                    // $order['order_log'] = json_encode($record->toarray());
                    // $order['trans_id'] = $request->input('trans_id');
                    // $order['type'] = 'coupon';
                    // $order['user_name'] = $auth->name;
                    // $order['user_email'] = $auth->email;
                    // $order['user_phone'] = $auth->mobile;
                    // $order_create = Order::create($order);
                    if ($order_create->id) {
                        $update = array();
                        $update['order_log'] = json_encode($record->toarray());
                        $update['amount'] = $amount;
                        $update['type'] = 'coupon';
                        $aff = Order::where('id',$order_create->id)->update($update);
                        $coupon_data = HotelCoupon::where('id', $value->coupon_id)->first();
                        $hotel_data = Hotel::where('id', $record->hotel_id)->first();
                        $orderItems['order_id'] = $order_create->id;
                        $orderItems['coupon_id'] = $record->id;
                        $orderItems['hotel_id'] = $hotel_data->id;
                        $orderItems['coupon'] = $record->custom_coupon_id;
                        $orderItems['category_id'] = $coupon_data->category_id;
                        $orderItems['coupon_data'] = json_encode($coupon_data);
                        $orderItems['hotel_data'] = json_encode($hotel_data);
                        $orderItems['valid_date'] = $coupon_data->valid_date;
                        $orderItems['visit_type'] = $coupon_data->visit_type;
                        $orderItems['mobile_number'] = $auth->mobile;
                        $orderItems['type'] = 'Coupon';
                        $order_details_create = OrderDetails::create($orderItems);
                        Cart::where('customer_id', Auth::guard('customer')->user()->id)->delete();
                        $success = true;
                        $message = __('api.order.success');
                    } else {
                        $success = true;
                        $message = __('api.order.fail');
                    }
                }
            }
            Cart::where('customer_id', Auth::guard('customer')->user()->id)->delete();
            $success = true;
            $message = __('api.order.success');
            $update_order['amount'] = $amount;
            $update_order = Order::where('id', $order_create->id)->update($update_order);
        } catch(Exception $e) {
            $success = false;
            $message = __('api.order.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;
        return response()->json($response, 200);
    }
    public function myOrder(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            if($request->input('type')!=""){

            // $records = Order::where('user_id', Auth::guard('customer')->user()->id)->where('type',$request->input('type'))->with(['orderDetails'])->get();
            // }else{
            //     $records = Order::where('user_id', Auth::guard('customer')->user()->id)->with(['orderDetails'])->get();
            // }

              $records = Order::where('user_id', Auth::guard('customer')->user()->id)->where('type',$request->input('type'))->get();
            }else{
                $records = Order::where('user_id', Auth::guard('customer')->user()->id)->get();
            }

            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.order.record_not_found');
            }
        } catch(Exception $e) {
            $success = false;
            $message = __('api.order.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;
        return response()->json($response, 200);
    }
    public function getorderbyid(Request $request) {
        $success = false;
        $message = '';
        $data = null;
            $validator = Validator::make($request->all(), [
            'id' => 'required',
            ]);
            if ($validator->fails()) {
                 return response()->json(['error' => $validator->errors()], 401);
            }
            try {
                $auth = Auth::user();
                $records = Order::where('user_id', Auth::guard('customer')->user()->id)->where('id',$request->input('id'))->with(['orderDetails'])->get();
                if ($records) {
                    $success = true;
                    $data = $records;
                } else {
                    $success = false;
                    $message = __('api.order.record_not_found');
                }
            } catch(Exception $e) {
                $success = false;
                $message = __('api.order.fail');
            }
            $response['success'] = $success;
            $response['message'] = $message;
            $response['data'] = $data;
           return response()->json($response, 200);
        }
        public function orderDetails(Request $request)
        {
            $success = false;
            $message = '';
            $data = null;
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            try {
                $auth = Auth::user();
                //$records = orderDetails::where('order_id', $request->input('order_id'))->with('order')->get();
                $records = Order::where('id', $request->input('order_id'))->where('type','package')->with('packageDetails')->first();
                if ($records) {
                    // foreach($records as $v){
                    // $v->coupon_data = json_decode($v->coupon_data);
                    // $v->hotel_data = json_decode($v->hotel_data);
                    // }
                    $success = true;
                    $data = $records;
                } else {
                    $success = false;
                    $message = __('api.order.record_not_found');
                }
            } catch(Exception $e) {
                $success = false;
                $message = __('api.order.fail');
            }
            $response['success'] = $success;
            $response['message'] = $message;
            $response['data'] = $data;
            return response()->json($response, 200);
        }
        public function voucherDetails(Request $request)
        {
            $success = false;
            $message = '';
            $data = null;
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            try {
                $auth = Auth::user();
                //$records = orderDetails::where('order_id', $request->input('order_id'))->with('order')->get();
                $records = Order::where('id', $request->input('order_id'))->where('type','coupon')->with('orderDetails')->first();
                if ($records) {
                    // foreach($records as $v){
                    // $v->coupon_data = json_decode($v->coupon_data);
                    // $v->hotel_data = json_decode($v->hotel_data);
                    // }
                    $success = true;
                    $data = $records;
                } else {
                    $success = false;
                    $message = __('api.order.record_not_found');
                }
            } catch(Exception $e) {
                $success = false;
                $message = __('api.order.fail');
            }
            $response['success'] = $success;
            $response['message'] = $message;
            $response['data'] = $data;
            return response()->json($response, 200);
        }
        public function package_coupon(Request $request)
        {
            $success = false;
            $message = '';
            $data = null;
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'package_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            try {
                $auth = Auth::user();
                $records = orderDetails::where('order_id', $request->input('order_id'))->where('package_id',$request->input('package_id'))->get();
                // $records = Order::where('id', $request->input('order_id'))->where('package_id',$request->input('package_id'))->with('orderDetails')->first();
                $search = $request->input('package_id');
                // $records = Order::whereHas('orderDetails', function($q) use($search){
                // $q->where('package_id', $search);
                // })->get();
                if ($records) {
                    // foreach($records as $v){
                    // $v->coupon_data = json_decode($v->coupon_data);
                    // $v->hotel_data = json_decode($v->hotel_data);
                    // }
                    $success = true;
                    $data = $records;
                } else {
                    $success = false;
                    $message = __('api.order.record_not_found');
                }
            } catch(Exception $e) {
                $success = false;
                $message = __('api.order.fail');
            }
            $response['success'] = $success;
            $response['message'] = $message;
            $response['data'] = $data;
            return response()->json($response, 200);
        }
}
