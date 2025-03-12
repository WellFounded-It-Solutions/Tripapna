<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
