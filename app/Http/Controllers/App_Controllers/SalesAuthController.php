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

    public function update_profile(Request $request){

        $id = Auth::id(); 
        $customers = Customer::where('id',$id) ;

        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'mobile'=> "required"
        ], [
            'email.required' => 'Email is required',
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile no. is required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $customers->update($input);
        $success = true;
        return response()->json(['success' => $success], 200);
    }
    
    public function update_password(Request $request){
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Password is required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $customers->update($input);
        $success = true;
        return response()->json(['success' => $success], 200);
    }
    public function inviteLink(Request $request){
        $request->validate([
            'hotel_id' => 'required',
            'package_id' => 'required',
            'name'=> "required",
            'phone' => "required",
            'email' => "required",
            'mode_of_pay'=>'required',
            'amount'=> 'required',
        ], [
            'hotel_id.required' => 'Hotel is required',
            'package_id.required' => 'Package is required',
            'name.required' => 'Name is required',
            'whatsapp.required' => 'Whatsapp no. is required',
            'email.required' => 'Email is required',
            'mode_of_pay.required' => 'Mode of pay is required',
            'amount.required'=> 'Amount is required',


        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = [];
        $input['customer_id'] = Auth::id;
        $input['qty'] = 1;
        $input['coupon_id'] = $request->input('package_id');
        $input['amount'] = $request->input('amount');
        $input['type'] = 'package';

        $create_record = Cart::create($input);
        if ($create_record) {
            $success = true;
            $message = __('api.cart.success');
            $data = $create_record;
            $tempmsg =  'Welcome to tripapana Here is Your account details Email:' + $request->input('email') +'password' +  '12345678' + 'Please Chage it Within 1 hr';
            $tempsubject = 'Invite link From Tripapna';
            sendEmail($request->input('email'),$tempmsg,$tempsubject);
        } else {
            $success = false;
            $message = __('api.cart.fail');
        }

        return response()->json(['success' => $success,'message' => $message], 200);
    }

    public function inviteForm(Request $request){
  $request->validate([
            'hotel_id' => 'required',
            'package_id' => 'required',
            'name'=> "required",
            'whatsapp' => "required",
            'email' => "required",
            'dob'=> "required",
            'phone' => "required",
            'mode_of_pay'=>'required',
            'amount'=> 'required',

        ], [
            'hotel_id.required' => 'Hotel is required',
            'package_id.required' => 'Package is required',
            'name.required' => 'Name is required',
            'whatsapp.required' => 'Phone is required',
            'email.required' => 'Email is required',
            'dob.required' => 'Date of Birth is required',
            'phone.required' => 'Phone Number is required',
            'mode_of_pay.required' => 'Mode of pay is required',
            'amount.required'=> 'Amount is required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = [];
        $input['customer_id'] = Auth::id;
        $input['qty'] = 1;
        $input['coupon_id'] = $request->input('package_id');
        $input['amount'] = $request->input('amount');
        $input['type'] = 'package';
        $create_record = Cart::create($input);
    
        if ($create_record) {
            $success = true;
            $message = __('api.cart.success');
            $data = $create_record;
            $tempmsg =  'Welcome to tripapana Here is Your account details Email:' + $request->input('email') +'password' +  '12345678' + 'Please Chage it Within 1 hr';
            $tempsubject = 'Invite link From Tripapna';
            sendEmail($request->input('email'),$tempmsg,$tempsubject);
        } else {
            $success = false;
            $message = __('api.cart.fail');
        }
            
        return response()->json(['success' => $success,'message' => $message], 200);
    }
    public function sendEmail($to,$msg,$subject){
        Mail::to($to)->send(new inviteEmail($msg, $subject));
    }
}
