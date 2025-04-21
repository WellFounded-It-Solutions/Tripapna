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
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return Response
     */
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
        if (Auth::guard('customer')->attempt($credentials)) {
            // Regenerate session to prevent session fixation attack
            // $request->session()->regenerate();

            return response()->json([
                'data' => Auth::guard('customer')->user(),
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




    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:customers,email',
                'mobile' => 'required|numeric|unique:customers,mobile',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ],
            [
                'name.required' => 'email is required',
                'email.required' => 'email is required',
                'email.unique' => 'email is already register',
                'mobile.required' => 'mobile is required',
                'mobile.unique' => 'mobile is already register',
                'password.required' => 'password is required',
                'c_password.required' => 'password is required'
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        unset($input['c_password']);
        $user = Customer::create($input);
        $success['token'] = Auth::attempt(['email' => request('email'), 'password' => request('password')]);
        $success['name'] = $user->name;

        return response()->json(['success' => $success], 200);
    }
    public function get_user(Request $request)
    {
        $request->validate([
            'customer_id' => 'required'
        ], [
            'customer_id.required' => 'Customer is required',
        ]);

        try {
            $record = Customer::where('id', $request->input('customer_id'))->get();

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => __('api.cart.success'),
                'data' => $record,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('api.cart.fail'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update_profile(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $validation_array = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $user->id,
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Validate input
        $validator = Validator::make($request->all(), $validation_array);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        // Prepare data for update
        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/uploads', $imageName); // Store image in storage/app/public/uploads
            $update['image'] = $imageName;
        }
        // Update user profile
        Customer::where('id', $user->id)->update($update);
        $updatedUser = Customer::find($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'data' => $updatedUser
        ]);
    }
    public function update_password(Request $request)
    {
        $input = $request->all();
        $validation_array['current_password'] = 'required';
        $validation_array['new_password'] = 'required:min:8';
        $validation_array['new_confirm_password'] = 'same:new_password';
        $validator = Validator::make($request->all(), $validation_array, [
            'current_password.required' => 'current password is required',
            'new_password.required' => 'New password is required',
            'new_confirm_password.required' => 'new password  is required',
        ]);
        if (!$validator->fails()) {
            $auth = Auth::user();
            if (!Hash::check($input['current_password'], $auth->password)) {
                $response['data'] = null;
                $response['message'] = 'Your current password not correct'; //add logic here
                $response['success'] = false;

                return response()->json($response);
                exit;
            } else {
                $update['name'] = $input['name'];
                // $update['email'] = $input['email'];
                $update['mobile'] = $input['mobile'];
                $update['password'] = Hash::make($input['new_password']);
                $affrow = Customer::where('id', $auth->id)->update($update);
                if ($affrow) {
                    auth()->logout();
                    $response['message'] = 'Your password  is updated successfully'; //add logic here
                    $response['success'] = true;
                }
            }
        } else {
            return response()->json(['error' => $validator->errors()], 401);
        }

        return response()->json($response);
        exit;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $id = auth()->user()->id;
        $userdata = DB::table('tbl_orders')
            ->select([
                DB::raw('COUNT(*) AS count'),
                DB::raw('SUM(amount) AS total'),
            ])
            ->where('user_id', $id)
            ->where('type', 'package')
            ->first();
        $userdatac = DB::table('tbl_orders')
            ->select([
                DB::raw('COUNT(*) AS count'),
                DB::raw('SUM(amount) AS total'),
            ])
            ->where('user_id', $id)
            ->where('type', 'coupon')
            ->first();

        auth()->user()->total_pakage = $userdata->count;
        auth()->user()->amount = $userdata->total;
        auth()->user()->coupon = $userdatac->count;
        $response['data'] = auth()->user();
        $response['success'] = true;
        $response['message'] = '';

        return response()->json($response, 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful',
            'success' => true,
        ])->withCookie(cookie()->forget(config('session.cookie')));
    }




    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user(),
            'expires_in' => auth()->factory()->getTTL() * 60 * 24,
        ]);
    }


}
