<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\HotelModulePermission;
use App\Models\HotelRolePermission;
use Validator;

class HotelPanelController extends Controller
{
    private function check($request, $module, $response_type)
    {
        $record = HotelModulePermission::select('id')->where('slug',$module)->first();
        $check = HotelRolePermission::where(['role_id'=>$request->user()->role_id,'permission_id'=>$record->id])->count();

        if($request->user()->role_id==2){
            $check = HotelRolePermission::where(['role_id'=>$request->user()->role_id,'permission_id'=>$record->id,'hotel_id'=>$request->user()->hotel_id])->count();
        }
        if ($check) {
            return true;
        } else {
            if ($response_type == 'view') {
                abort(404);
            }
            return false;
        }
    }
    public function login(Request $request)
    {
        $route_name = Route::currentRouteName();
        $success = true;
        $message = '';
        $webpath = URL('/');
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                ]);
            if (! $validator->fails()) {
                $data = $request->input();
                if (Auth::guard('hotel')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 'Active'])) {
                    $response['success'] = $success;
                    $response['message'] = 'Login Successfully';
                    $user = $request->user(); //getting the current logged in user
                    $response['redirectURL'] = $webpath.'/hoteladmin/dashboard';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Email or password is wrong';
                }
            } else {
                $response['success'] = false;
                $html = "<ol type='1'>";
                foreach ($validator->errors()->toarray() as $value) {
                    $html .= '<li>'.$value['0'].'</li>';
                }
                $html .= '</ol>';
                $response['message'] = $html;
            }

            return response()->json($response);
            exit;
        }

        return view('hotelpanel.login', compact('route_name'));
    }

    public function update(Request $request)
    {
        $route_name = Route::currentRouteName();
        $success = true;
        $message = '';
        $webpath = URL('/');
        if ($request->isMethod('post')) {
        $check = $this->check($request, 'p-update', 'ajax');
        if ($check) {
            $input = $request->all();
            $validation_array = [
                'name' => 'required',
                'location' => 'required',
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                
            ];
            if ($input['new_password'] != '') {
                $validation_array['current_password'] = 'required';
                $validation_array['new_password'] = 'required:min:8';
                $validation_array['new_confirm_password'] = 'same:new_password';
            }
            if ($request->hasFile('logo')) {
                 $validation_array['logo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
            }
            $validator = Validator::make($request->all(), $validation_array);
            if (! $validator->fails()) {
                if ($input['new_password'] != '') {
                    $auth = Auth::user();
                    if (! Hash::check($input['current_password'], $auth->password)) {
                        $response['message'] = 'Your current password not correct'; //add logic here
                        $response['success'] = false;

                        return response()->json($response);
                        exit;
                    } else {
                        $update['name'] = $input['name'];
                        $update['location'] = $input['location'];
                        $update['mobile'] = $input['mobile'];
                          if ($request->hasFile('logo')) {
                                $imageName = time().'.'.$request->logo->extension(); 
                                $request->logo->move(public_path('logo'), $imageName);
                                $update['logo'] = $imageName;
                          }
                        $update['password'] = bcrypt($input['new_password']);
                        $affrow = Hotel::where('id', $auth->id)->update($update);
                        if ($affrow) {
                            Auth::guard('hotel')->logout();
                            $response['redirectURL'] = $webpath.'/hoteladmin/dashboard';
                        }
                    }
                } else {
                    $update['name'] = $input['name'];
                    $update['location'] = $input['location'];
                    $update['mobile'] = $input['mobile'];
                    if ($request->hasFile('logo')) {
                        $imageName = time().'.'.$request->logo->extension(); 
                        $request->logo->move(public_path('logo'), $imageName);
                        $update['logo'] = $imageName;
                    }
                    $affrow = Hotel::where('id', Auth::id())->update($update);
                    if ($affrow) {
                        $response['message'] = 'Your profile is updated successfully'; //add logic here
                        $response['success'] = true;
                    }
                }
            } else {
                $response['success'] = false;
                $html = "<ol type='1'>";
                foreach ($validator->errors()->toarray() as $value) {
                    $html .= '<li>'.$value['0'].'</li>';
                }
                $html .= '</ol>';
                $response['message'] = $html;
            }
        }else{
             $response['success'] = false;
            $response['message'] = "You don't have permission";
        }  
            return response()->json($response);
            exit;
        }
        $this->check($request,'p-view', 'view');
        return view('hotelpanel.profile', compact('route_name'));
    }

    public function logout()
    {
        Auth::guard('hotel')->logout();

        return redirect()->route('login');
    }
}
