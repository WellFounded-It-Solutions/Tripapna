<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Facades\DB;

class SalesAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'email.email' => 'Please enter a valid email'
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Use the 'customer' guard
        if (Auth::guard('web')->attempt($credentials)) {
            // Regenerate session to prevent session fixation attack
            // $request->session()->regenerate();
    
            return response()->json([
                'data' => Auth::guard('web')->user(),
                'message' => 'Login successful',
                'success' => true,
            ]);
        }
    
        // If authentication fails
        return response()->json([
            'data' => null,
            'message' => 'Invalid credentials',
            'success' => false,
        ], 401);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json([
            'message' => 'Logout successful',
            'success' => true,
        ]);
    }

  
public function update_profile(Request $request) {
    $id = Auth::guard("web")->id(); // Fixed Auth::id() usage

    // Validate input
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string',
        'mobile' => 'required|string',
    ], [
        'email.required' => 'Email is required',
        'email.email' => 'Enter a valid email address',
        'name.required' => 'Name is required',
        'mobile.required' => 'Mobile number is required',
    ]);

    try {
        // Fetch customer record
        $customer = Customer::where('id', $id)->firstOrFail();

        // Update profile
        $customer->update($request->only(['email', 'name', 'mobile']));

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'customer' => $customer,
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!',
            'error' => $e->getMessage(),
        ], 500);
    }
}
    
public function update_password(Request $request) {
    $id =  Auth::guard("web")->id(); // Fixed Auth::id() usage

    // Validate input
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ], [
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters long',
        'password.confirmed' => 'Passwords do not match',
    ]);

    try {
        // Fetch customer record
        $customer = Customer::where('id', $id)->firstOrFail();

        // Hash and update the password
        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    public function inviteLink(Request $request) {
        $request->validate([
            'hotel_id' => 'required',
            'package_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'mode_of_pay' => 'required',
            'amount' => 'required',
        ], [
            'hotel_id.required' => 'Hotel is required',
            'package_id.required' => 'Package is required',
            'name.required' => 'Name is required',
            'phone.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'mode_of_pay.required' => 'Mode of pay is required',
            'amount.required' => 'Amount is required',
        ]);
    
        try {
            $input = [];
            $input['customer_id'] =  Auth::guard("web")->id();  // Fix Auth::id() usage
            $input['qty'] = 1;
            $input['coupon_id'] = $request->input('package_id');
            $input['amount'] = $request->input('amount');
            $input['type'] = 'package';
            dd($input);
    
            $create_record = Cart::create($input);
    
            if ($create_record) {
                $tempmsg = 'Welcome to Tripapana. Here are your account details: Email: ' . $request->input('email') . ', Password: 12345678. Please change it within 1 hour.';
                $tempsubject = 'Invite link From Tripapana';
    
                sendEmail($request->input('email'), $tempmsg, $tempsubject);
    
                return response()->json([
                    'success' => true,
                    'message' => __('api.cart.success'),
                    'data' => $create_record
                ], 200);
            }
    
            return response()->json([
                'success' => false,
                'message' => __('api.cart.fail')
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function inviteForm(Request $request) {
        $request->validate([
            'hotel_id' => 'required',
            'package_id' => 'required',
            'name' => 'required',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'phone' => 'required',
            'mode_of_pay' => 'required',
            'amount' => 'required',
        ], [
            'hotel_id.required' => 'Hotel is required',
            'package_id.required' => 'Package is required',
            'name.required' => 'Name is required',
            'whatsapp.required' => 'WhatsApp number is required',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'dob.required' => 'Date of Birth is required',
            'dob.date' => 'Date of Birth must be a valid date',
            'phone.required' => 'Phone number is required',
            'mode_of_pay.required' => 'Mode of payment is required',
            'amount.required' => 'Amount is required',
        ]);
    
        try {
            $input = [
                'customer_id' =>  Auth::guard("web")->id(), // Fixed Auth::id() usage
                'qty' => 1,
                'coupon_id' => $request->input('package_id'),
                'amount' => $request->input('amount'),
                'type' => 'package',
            ];
    
            $create_record = Cart::create($input);
    
            if ($create_record) {
                $tempmsg = 'Welcome to Tripapana. Here are your account details: Email: ' 
                    . $request->input('email') . ', Password: 12345678. Please change it within 1 hour.';
                $tempsubject = 'Invite Link From Tripapana';
    
                $this->sendEmail($request->input('email'), $tempmsg, $tempsubject);
    
                return response()->json([
                    'success' => true,
                    'message' => __('api.cart.success'),
                    'data' => $create_record
                ], 200);
            }
    
            return response()->json([
                'success' => false,
                'message' => __('api.cart.fail')
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
  
public function sendEmail($to, $msg, $subject) {
    try {
        Mail::to($to)->send(new InviteEmail($msg, $subject));
    } catch (\Exception $e) {
        \Log::error('Email sending failed: ' . $e->getMessage());
    }
}
}
