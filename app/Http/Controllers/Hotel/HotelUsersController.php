<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\RolePermission;
use App\Models\Hotel;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class HotelUsersController extends Controller
{
    public $destination_image_path = 'public/users/';

     private function check($request, $response_type)
    {
        if ($request->user()->role_id==1) {
            return true;
        } else {
            if ($response_type == 'view') {
                abort(404);
            }
            return false;
        }
    }

    public function index(Request $request)
    {
        $check = $this->check($request, 'view');
        if ($check) {
            $manegers ="";
            $page_name = 'Users';

            return view('hotelpanel.users.index', compact('page_name', 'manegers'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-user', 'view');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != 'undefined') {
                        $records = Hotel::where('hotel_id',  Auth::user()->id)->where(function ($query) {
                            $keyword = $_GET['title'];
                            $query->where('name', 'like', '%'.$keyword.'%')
                                ->orWhere('email', 'like', '%'.$keyword.'%')
                                ->orWhere('mobile', 'like', '%'.$keyword.'%');
                        })->paginate(15);
                } else {
                        $records = Hotel::where('hotel_id',  Auth::user()->id)->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotelpanel.users.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-user', 'ajax');
        if ($check) {
            $record = User::where(['id' => $id])->first();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
            } else {
                $response['success'] = false;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;

        return response()->json($response);
        exit;
    }

    public function store(Request $request)
    {
        $check = $this->check($request, 'create-user', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email:rfc,dns|unique:hotels,email',
                        'password' => 'required|min:8',
                        'role_id' => 'required',
                        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    ]);
                if (! $validator->fails()) {
                    try {
                        $input = $request->all();
                        unset($input['confirmed']); 
                        $input['password'] = bcrypt($input['password']);
                        $input['hotel_id'] = Auth::user()->id;
                        $user = Hotel::create($input);
                        // if ($user) {
                        //     $addToUserRole = [];
                        //     $addToUserRole['user_id'] = $user->id;
                        //     $addToUserRole['role_id'] = $input['role'];
                        //     UserRoles::create($addToUserRole);
                        // }
                        $response['success'] = true;
                        $response['message'] = 'Recored Store SuccessFully';
                        $response['resetForm'] = true;
                        $response['callBackFunction'] = 'addCallBack';
                    } catch (exception $e) {
                        $response['success'] = false;
                        $response['message'] = 'There is some error please try after some time';
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
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function update(Request $request)
    {
        $check = $this->check($request, 'edit-user', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = ['name' => 'required|alpha'];
                $validation_array = ['password' => 'required|min:8'];
                $validation_array = ['mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['confirmed']);
                    $update['password'] = bcrypt($update['password']);
                    $user = User::where('id', $update['id'])->update($update);
                    $response['success'] = true;
                    $response['message'] = 'Records Updated SuccessFully';
                    $response['callBackFunction'] = 'updatedCallback';
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
        }

        return response()->json($response);
        exit;
    }

    public function change_status(Request $request, $id, $status)
    {
        $check = $this->check($request, 'ai-user', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Hotel::where('id', $id)->update($update);
            $response['success'] = true;
            $response['message'] = 'Status Changed SuccessFully';

            return response()->json($response);
            exit;
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $check = $this->check($request, 'delete-user', 'ajax');
        if ($check) {
            $affectedRows = Hotel::where('id', $id)->delete();
            // RolePermission::where('role_id', $id)->delete();
            if ($affectedRows) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }
}
