<?php

namespace App\Http\Controllers\App_Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Razorpay\Api\Api;
use Exception;

class PaymentController extends Controller
{
    private $razorpayId;
    private $razorpayKey;

    public function __construct()
    {
        $this->razorpayId = env('RAZORPAY_KEY');    // from .env
        $this->razorpayKey = env('RAZORPAY_SECRET'); // from .env
    }

    /**
     * ✅ Create Razorpay Order API
     */
    public function createOrder(Request $request)
    {
        try {
            $api = new Api($this->razorpayId, $this->razorpayKey);

            $order = $api->order->create([
                'receipt'         => uniqid(),
                'amount'          => $request->amount * 100, // amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1, // auto capture
            ]);
            return response()->json([
                'status' => true,
                'order_id' => $order['id'],
                'amount' => $order['amount'],
                'currency' => $order['currency']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ Verify Razorpay Payment Signature
     */
    public function verifyPayment(Request $request)
    {
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_signature = $request->razorpay_signature;

        try {
            $api = new Api($this->razorpayId, $this->razorpayKey);

            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // ✅ Store in DB (example)
            \DB::table('Transaction')->insert([
                'order_id' => $razorpay_order_id,
                'payment_id' => $razorpay_payment_id,
                'signature' => $razorpay_signature,
                'status' => 'success',
                'created_at' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Payment verified successfully',
                'data' => $attributes
            ]);
        } catch (Exception $e) {
            // ❌ Verification failed
            \DB::table('Transaction')->insert([
                'order_id' => $razorpay_order_id,
                'payment_id' => $razorpay_payment_id,
                'signature' => $razorpay_signature,
                'status' => 'failed',
                'created_at' => now(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Payment verification failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
