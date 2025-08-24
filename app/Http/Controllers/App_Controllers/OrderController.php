<?php
namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\HotelCoupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderPackageDetails;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function orderPlace(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $user_id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');

        $validator = Validator::make($request->all(), [
            'trans_id' => 'required',
            'id' => 'required',
            'name'=> 'required',
            'email'=> 'required|email',
            'mobile'=> 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            // $auth = Auth::user();
            $cart = Cart::where('customer_id', $user_id)->get();
            $amount = 0;
            $order['order_id'] = orderCode();
            $order['user_id'] = $user_id;
            $order['amount'] = $amount;
            $order['trans_id'] = $request->input('trans_id');
            $order['type'] = 'package';
            $order['user_name'] = $name;
            $order['user_email'] = $email;
            $order['user_phone'] = $mobile;
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
                                $orderItems['mobile_number'] = $mobile;
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
                                $orderItems['mobile_number'] = $mobile;
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
                    // $order['user_id'] = $auth->id;
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
                        $orderItems['mobile_number'] = $mobile;
                        $orderItems['type'] = 'Coupon';
                        $order_details_create = OrderDetails::create($orderItems);

                        Cart::where('customer_id', $user_id)->delete();
                        $success = true;
                        $message = __('api.order.success');
                    } else {
                        $success = true;
                        $message = __('api.order.fail');
                    }
                }
            }
            Cart::where('customer_id', $user_id)->delete();
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
            
            // $records = Order::where('user_id', $auth->id)->where('type',$request->input('type'))->with(['orderDetails'])->get();
            // }else{
            //     $records = Order::where('user_id', $auth->id)->with(['orderDetails'])->get();
            // }
            
              $records = Order::where('user_id', $auth->id)->where('type',$request->input('type'))->get();
            }else{
                $records = Order::where('user_id', $auth->id)->get();
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
                $records = Order::where('user_id', $auth->id)->where('id',$request->input('id'))->with(['orderDetails'])->get();
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
    
