<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\HotelCoupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderPackageDetails;
use App\Models\Package;
use App\Models\PhonePeOrders;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Http;
class PaymentController extends Controller
{
    public function phone_redirect_url(Request $request)
    {
        $myfile = fopen("phonePeCallBack.txt", "w") or die("Unable to open file!");
        $inputs = file_get_contents('php://input');
        $txt = $inputs;
        fwrite($myfile, $txt);
        fclose($myfile);
        $request = $request->all();
        $order_id = $request['merchantOrderId'];
        $transactionId = $request['transactionId'];
        $code = $request['code'];
        if($code == 'PAYMENT_SUCCESS')
        {
	        try {
	            $phonepe_order = PhonePeOrders::where(['order_id'=>$order_id,'transaction_id'=>$transactionId,'status'=>0])->first();
	            $customer_id = $phonepe_order->customer_id;
	            $auth = Customer::find($customer_id);
	            $cart = Cart::where('customer_id', $auth->id)->get();
	            $amount = 0;
	            $order['order_id'] = $order_id;
	            $order['user_id'] = $auth->id;
	            $order['amount'] = $amount;
	            $order['trans_id'] = $transactionId;
	            $order['type'] = 'package';
	            $order['user_name'] = $auth->name;
	            $order['user_email'] = $auth->email;
	            $order['user_phone'] = $auth->mobile;
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
	                        $orderItems['mobile_number'] = $auth->mobile;
	                        $orderItems['type'] = 'Coupon';
	                        $order_details_create = OrderDetails::create($orderItems);
	                        Cart::where('customer_id', $auth->id)->delete();
	                    }
	                }
	            }
	            Cart::where('customer_id', $auth->id)->delete();
	            $update_order['amount'] = $amount;
	            $update_order = Order::where('id', $order_create->id)->update($update_order);
	           	PhonePeOrders::where('id', $phonepe_order->id)->update(['status'=>1]);
	            return redirect(env('FRONTEND_APP_PATH').'/dashboard');
	        } catch(Exception $e) {
	            return redirect(env('FRONTEND_APP_PATH').'/dashboard');
	        }
        }
        return redirect(env('FRONTEND_APP_PATH').'/dashboard');
    }
    public function createOrder(Request $request)
    {
        $amount = $request->input('amount');
        $orderId = $request->input('orderId');

        $payload = [
            'merchantId' => env('PHONEPE_MERCHANT_ID'),
            'transactionId' => $orderId,
            'amount' => $amount,
            'merchantUserId' => env('PHONEPE_MERCHANT_SUB_ID'),
            'redirectUrl' => env('PHONEPE_REDIRECT_URL'),
            'message' => 'Payment for order ' . $orderId,
            'email' => 'customer@example.com'
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $this->generateXVerifyHeader($payload)
        ])->post('https://api.phonepe.com/apis/hermes/pg/v1/pay', $payload);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Payment initiation failed'], 500);
        }
    }
    private function generateXVerifyHeader($payload)
    {
        $data = json_encode($payload);
        $salt = env('PHONEPE_MERCHANT_SECRET_KEY');
        $checksum = hash('sha256', $data . $salt);
        return $checksum . '###' . env('PHONEPE_MERCHANT_ID');
    }
    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-hotel', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = Hotel::where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('name', 'like', '%'.$keyword.'%')
                        ->orWhere('location', 'like', '%'.$keyword.'%');
                    })->paginate(15);
                } else {
                    $records = Hotel::paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotels.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();
                return response()->json($response);
                exit;
            }
        }
    }
}