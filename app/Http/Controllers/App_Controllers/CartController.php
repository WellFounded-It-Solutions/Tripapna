<?php

namespace App\Http\Controllers\App_Controllers;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\HotelCoupon;
use App\Models\PromoCode;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['addtocart','removeCart','viewCart']]);
    }

    public function addtocart(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'qty' => 'required',
            'coupon_id' => 'required',
            'type' => 'required|string|in:package,coupon',
            'user_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
                    $auth = $request->input("user_id");
                    $check_record = Cart::where('customer_id',$auth)->first();
                    if($check_record!=null){
                        if($check_record->type!=$request->input('type')){
                            $success = false;
                            $message = "You can add at a time one Package or Coupon";
                            $response['success'] = $success;
                            $response['message'] = $message;
                            $response['data'] = $data;

                            return response()->json($response, 200);
                        }
                    }
            if ($request->input('type') == 'coupon') {
                $record = HotelCoupon::where(['id' => $request->input('coupon_id'), 'status' => 'Active'])->first();
                if ($record) {
                    $input = [];
                    $input['coupon_id'] = $request->input('coupon_id');
                    $input['qty'] = $request->input('qty');
                    $input['amount'] = $record->amount;
                    $input['type'] = 'coupon';
                    $input['customer_id'] = $auth;
                    $create_record = Cart::create($input);
                    if ($create_record) {
                        $success = true;
                        $message = __('api.cart.success');
                        $data = $create_record;
                    } else {
                        $success = false;
                        $message = __('api.cart.fail');
                    }
                } else {
                    $success = true;
                    $message = __('api.cart.record_not_found');
                }
            } elseif ($request->input('type') == 'package') {
                $record = Package::where(['id' => $request->input('coupon_id'), 'status' => 'Active'])->first();
                if ($record) {
                    $auth = $request->input("user_id");
                    $input = [];
                    $input['coupon_id'] = $request->input('coupon_id');
                    $input['qty'] = $request->input('qty');
                    $input['amount'] = $record->amount;
                    $input['type'] = 'package';
                    $input['customer_id'] = $auth;
                    $create_record = Cart::create($input);
                    if ($create_record) {
                        $success = true;
                        $message = __('api.cart.success');
                        $data = $create_record;
                    } else {
                        $success = false;
                        $message = __('api.cart.fail');
                    }
                } else {
                    $success = true;
                    $message = __('api.cart.record_not_found');
                } 
            }
        } catch(Exception $e) {
            $success = false;
            $message = __('api.cart.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function removeCart(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $affected_row = Cart::where('id', $request->input('cart_id'))->delete();
            if ($affected_row) {
                $success = true;
                $message = __('api.cart.record_deleted');
            } else {
                $success = false;
                $message = __('api.cart.record_not_found');
            }
        } catch(Exception $e) {
            $success = false;
            $message = __('api.cart.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function viewCart(Request $request)
    {
          // Validate input
    $request->validate([
        'user_id' => 'required',
    ], [
        'user_id.required' => 'Wallet amount is required',
    ]);
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = $request->input("user_id");
            $records = Cart::where('customer_id', $auth)->with(['coupons','Package'])->get();
            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.cart.record_not_found');
            }
        } catch(Exception $e) {
            $success = false;
            $message = __('api.cart.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }
 
    public function createOrder(Request $reques){
        $keyId = env('RAZORPAY_KEY');
        $keySecret = env('RAZORPAY_SECRET');

        $api = new Api($keyId, $keySecret);

        $amount = $request->amount * 100;

        try {
            $order = $api->order->create([
                'receipt'         => 'rcptid_' . uniqid(),
                'amount'          => $amount,
                'currency'        => 'INR',
                'payment_capture' => 1, 
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order['id'],
                'amount' => $amount,
                'currency' => 'INR',
                'key' => $keyId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    
    }
    public function applyCoupon(Request $request)
{
    $validator = Validator::make($request->all(), [
        'coupon_code' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
    }

    $couponCode = $request->coupon_code;

    $promoCode = PromoCode::where('promo_code', $couponCode)->first();

    if (!$promoCode) {
        return response()->json(['success' => false, 'message' => 'Invalid promo code'], 404);
    }

   

    // You need to perform the discount calculation here
    // The following is an example, you'll need to adjust based on your promo code logic
    // $originalPrice = 100; // Example original price
    // $discountAmount = $promoCode->discount_value;
    // $finalPrice = $originalPrice - $discountAmount;

    return response()->json([
        'success' => true,
        'message' => 'Promo code applied successfully',
        'promo_code' => $promoCode, // Change the key to match what you are returning
        // 'discount_amount' => $discountAmount,
        // 'final_price' => $finalPrice,
    ]);
}
}
