<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use App\Models\HotelCoupon;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class WishListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function add(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'type' => 'required|string|in:package,coupon',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            if ($request->input('type') == 'coupon') {
                $record = HotelCoupon::where(['id' => $request->input('item_id'), 'status' => 'Active'])->first();
                if ($record) {
                    $auth = Auth::user();
                    $input = [];
                    $input['type'] = $request->input('type');
                    $input['item_id'] = $request->input('item_id');
                    $input['customer_id'] = $auth->id;
                    $create_record = WishList::create($input);
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
            }else if ($request->input('type') == 'package') {
                $record = Package::where(['id' => $request->input('item_id'), 'status' => 'Active'])->first();
                if ($record) {
                    $auth = Auth::user();
                    $input = [];
                    $input['type'] = $request->input('type');
                    $input['item_id'] = $request->input('item_id');
                    $input['customer_id'] = $auth->id;
                    $create_record = WishList::create($input);
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

    public function remove(Request $request)
    {
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
            $affected_row = WishList::where('id', $request->input('id'))->delete();
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

    public function view(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $records = WishList::where('customer_id', $auth->id)->with(['coupons','package'])->get();
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
