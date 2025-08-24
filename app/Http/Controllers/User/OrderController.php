<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function __construct() {}

    // Create order by sending request to Razorpay orders API
    public function createOrder(Request $request)
    {
        // Create Razorpay API instance
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Disable SSL verification only in local/dev
       

        $order = $api->order->create([
            'receipt'         => 'receipt#1',
            'amount'          =>  (int) $request->input('amount') * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture
        ]);

        // For debugging you can use:
    

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data'    => $order
        ]);
    }

    public function myOrder(Request $request)
    {
        $records = Order::where('user_id', Auth::guard('customer')->user()->id)
                        ->where('type', 'package')
                        ->get();

        $pageTitle = 'My Order';
        return view('user.myorder', compact('records', 'pageTitle'));
    }

    public function getorderbyid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $records = Order::where('user_id', Auth::guard('customer')->user()->id)
                        ->where('id', $request->input('id'))
                        ->with(['orderDetails'])
                        ->get();

        return response()->json([
            'success' => $records->isNotEmpty(),
            'message' => $records->isNotEmpty() ? '' : __('api.order.record_not_found'),
            'data'    => $records
        ], 200);
    }

    public function orderDetails($id)
    {
        $records = Order::where('id', $id)
                        ->where('type', 'package')
                        ->with('packageDetails')
                        ->first();

        $pageTitle = 'Order Details';
        return view('user.orderdetails', compact('records', 'pageTitle'));
    }

    public function myVouchers(Request $request)
    {
        $records = Order::where('user_id', Auth::guard('customer')->user()->id)
                        ->where('type', 'coupon')
                        ->get();

        $pageTitle = 'My Order';
        return view('user.voucher', compact('records', 'pageTitle'));
    }

    public function voucherDetails($id)
    {
        $records = Order::where('id', $id)
                        ->where('type', 'coupon')
                        ->with('orderDetails')
                        ->first();

        return view('user.voucherdetails', compact('records'));
    }

    public function package_coupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'   => 'required',
            'package_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $records = \App\Models\OrderDetails::where('order_id', $request->input('order_id'))
                    ->where('package_id', $request->input('package_id'))
                    ->get();

        return response()->json([
            'success' => $records->isNotEmpty(),
            'message' => $records->isNotEmpty() ? '' : __('api.order.record_not_found'),
            'data'    => $records
        ], 200);
    }
}
