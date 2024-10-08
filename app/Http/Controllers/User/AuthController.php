<?php

namespace App\Http\Controllers\User;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct() {}
    public function login()
    {
        return view('user.login');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login successfully');
        } else {
            return redirect()->route('custmor_login')->with('error', 'Invalid credentials');
        }
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function register_post(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:customers,email',
                'mobile' => 'required|numeric|unique:customers,mobile',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]
        );
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        unset($input['c_password']);
        Customer::create($input);

        return redirect(route('custmor_login'))->with('success', 'Register successfully');
    }

    public function update_profile()
    {
        return view('user.update_profile');
    }

    public function update_profile_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'pincode' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'anniversary' => 'required',
        ]);

        $update = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'pincode' => $request->pincode,
            'anniversary' => $request->anniversary,
            'dob' => $request->dob,
            'address' => $request->address
        ];

        $affrow = Customer::where('id', Auth::guard('customer')->user()->id)->update($update);
        if ($affrow) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('error', 'Profile not updated');
        }
    }

    public function upadate_profie_image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/user/img/');

        $image->move($destinationPath, $input['imagename']);

        $update['image'] = $input['imagename'];

        $affrow = Customer::where('id', Auth::guard('customer')->user()->id)->update($update);
        if ($affrow) {
            return response()->json(['success' => 'Profile updated successfully']);
        } else {
            return response()->json(['error' => 'Profile not updated']);
        }
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


        return view('user.dashboard', ['user' => auth()->user()]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
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
