<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\HotelCoupon;
use App\Models\Package;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CartController extends Controller
{
    public function __construct() {}

    public function addtocart(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'qty' => 'required',
            'coupon_id' => 'required',
            'type' => 'required|string|in:package,coupon',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $auth = Auth::user();
            $check_record = Cart::where('customer_id', $auth->id)->first();
            if ($check_record != null) {
                if ($check_record->type != $request->input('type')) {
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
                    $input['customer_id'] = $auth->id;
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
                    $auth = Auth::user();
                    $input = [];
                    $input['coupon_id'] = $request->input('coupon_id');
                    $input['qty'] = $request->input('qty');
                    $input['amount'] = $record->amount;
                    $input['type'] = 'package';
                    $input['customer_id'] = $auth->id;
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
        } catch (Exception $e) {
            $success = false;
            $message = __('api.cart.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function removeCart($id)
    {
        try {
            $affected_row = Cart::where(['id' => $id , 'customer_id' => Auth::guard('customer')->user()->id])->delete();
            if ($affected_row) {
                return redirect(route('viewCart'));
            } else {
                return redirect(route('viewCart'));
            }
        } catch (Exception $e) {
        }
    }

    public function updateCart(Request $request)
    {

        $auth = Auth::guard('customer')->user();
        $input = [];
        $input['qty'] = $request->input('qty');
        $input['amount'] = Cart::where(['id' => $request->input('id') , 'customer_id' => $auth->id])->first()->amount;
        $affected_row = Cart::where(['id' => $request->input('id') , 'customer_id' => $auth->id])->update($input);
        if ($affected_row) {
           $response['success'] = true;
           $response['message'] = __('api.cart.success');
        } else {
            $response['success'] = false;
            $response['message'] = __('api.cart.fail');
        }
    }

    public function viewCart(Request $request)
    {

        $auth = Auth::guard('customer')->user();
        $data = Cart::where('customer_id', $auth->id)->with(['coupons', 'Package'])->get();

        $pageTitle = 'Cart';

        return view('user.cart', compact('data' , 'pageTitle'));
    }
 
    private function getCartItems()
    {
        $auth = Auth::guard('customer')->user();
        return Cart::where('customer_id', $auth->id)->with(['coupons', 'Package'])->get();
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





        // Store the promo code in the session


        $request->session()->put('applied_promo_code', [


            'code' => $promoCode->promo_code,


            'discount_percentage' => $promoCode->discount


        ]);





        // Calculate cart totals


        $cartItems = $this->getCartItems();


        $subtotal = collect($cartItems)->sum(function ($item) {


            return $item->amount * $item->qty;


        });


        $discount = $subtotal * ($promoCode->discount / 100); // Percentage-based discount


        $total = max(0, $subtotal - $discount); // Ensure total doesn't go negative





        return response()->json([


            'success' => true,


            'message' => 'Promo code applied successfully',


            'subtotal' => $subtotal,


            'discount' => $discount,


            'total' => $total


        ]);


    }
    
}

