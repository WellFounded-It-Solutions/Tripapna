<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $route_name = Route::currentRouteName();
        $success = true;
        $message = '';
        $webpath = URL('/');
        $role = Role::where('params', $route_name)->first();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                ]);
            if (! $validator->fails()) {
                $data = $request->input();
                $role = Role::where('params', $data['route_name'])->first();
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 'Active', 'role' => $role->id])) {
                    $user = User::where(['email' => $data['email']])
                        ->first();
                    $response['success'] = $success;
                    $response['message'] = 'Login Successfully';
                    $user = $request->user(); //getting the current logged in user
                    if ($user->hasRole('admin')) {
                        $response['redirectURL'] = $webpath.'/administrator/dashboard';
                    } elseif ($user->hasRole('subadmin')) {
                        $response['redirectURL'] = $webpath.'/subadmin/dashboard';
                    } elseif ($user->hasRole('manager')) {
                        $response['redirectURL'] = $webpath.'/manager/dashboard';
                    } elseif ($user->hasRole('agent')) {
                        $response['redirectURL'] = $webpath.'/agent/dashboard';
                    }
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

        return view('admin.admin_login', compact('route_name', 'role'));
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        Auth::logout(); // log the user out of our application
        if ($user->hasRole('admin')) {
            return Redirect::to('administrator'); // redirect the user to the login screen
        } elseif ($user->hasRole('subadmin')) {
            return Redirect::to('subadmin');
        } elseif ($user->hasRole('manager')) {
            return Redirect::to('manager');
        } elseif ($user->hasRole('agent')) {
            return Redirect::to('agent');
        }
    }

    public function update(Request $request)
    {
        $check = $this->check($request, 'edit-profile', 'ajax');
        if ($check) {
            $webpath = URL('/');
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validation_array = [
                    'name' => 'required',
                    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ];
                if ($input['new_password'] != '') {
                    $validation_array['current_password'] = 'required';
                    $validation_array['new_password'] = 'required:min:8';
                    $validation_array['new_confirm_password'] = 'same:new_password';
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
                            $update['mobile'] = $input['mobile'];
                            $update['password'] = bcrypt($input['new_password']);
                            $affrow = User::where('id', $auth->id)->update($update);
                            if ($affrow) {
                                $user = $request->user();
                                if ($user->hasRole('admin')) {
                                    $response['redirectURL'] = $webpath.'/administrator';
                                } elseif ($user->hasRole('subadmin')) {
                                    $response['redirectURL'] = $webpath.'/subadmin';
                                } elseif ($user->hasRole('manager')) {
                                    $response['redirectURL'] = $webpath.'/manager';
                                } elseif ($user->hasRole('agent')) {
                                    $response['redirectURL'] = $webpath.'/agent';
                                }
                                Auth::logout();
                            }
                        }
                    } else {
                        $update['name'] = $input['name'];
                        $update['mobile'] = $input['mobile'];
                        $affrow = User::where('id', Auth::id())->update($update);
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

                return response()->json($response);
                exit;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";

            return response()->json($response);
            exit;
        }
    }

    public function profile(Request $request)
    {
        $check = $this->check($request, 'view-profile', 'view');
        if ($check) {
            $user = Auth::user();
            $page_name = 'Profile';

            return view('admin.profile', compact('user', 'page_name'));
        }
    }

        private function check($request, $module, $response_type)
        {
            if ($request->user()->can($module)) {
                return true;
            } else {
                if ($response_type == 'view') {
                    abort(404);
                }

                return false;
            }
        }
}
