<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\HotelCoupon;
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
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
                    $auth = Auth::user();
                    $check_record = Cart::where('customer_id',$auth->id)->first();
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
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $records = Cart::where('customer_id', $auth->id)->with(['coupons','Package'])->get();
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
}
