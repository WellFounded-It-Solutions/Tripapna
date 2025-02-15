<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
    public $destination_image_path = 'public/users/';

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

    public function index(Request $request)
    {
        // $data = User::with('AssignHotels')->where('role', '1')->get();
        // $user = User::find(29);
        // dd($user);
        // $hotels = $user->hotels();
// 
        // dd($hotels);
        $check = $this->check($request, 'view-user', 'view');
        if ($check) {
            $manegers = User::where('role', '1')->get();
            $assignData = Hotel::select('id','name')->where('status','Active')->get();
            $assignPackage = Package::select('id','title')->where('status','Active')->get();
            $page_name = 'Users';

            return view('admin.users.index', compact('page_name', 'manegers','assignData','assignPackage'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-user', 'view');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    if (! $request->user()->hasRole('admin')) {
                        $records = User::where('id', '!=', 2)->where(function ($query) {
                            $keyword = $_GET['title'];
                            $query->where('name', 'like', '%'.$keyword.'%')
                                ->orWhere('email', 'like', '%'.$keyword.'%')
                                ->orWhere('mobile', 'like', '%'.$keyword.'%');
                        })->paginate(15);
                    } else {
                        $records = User::where(function ($query) {
                            $keyword = $_GET['title'];
                            $query->where('name', 'like', '%'.$keyword.'%')
                                ->orWhere('email', 'like', '%'.$keyword.'%')
                                ->orWhere('mobile', 'like', '%'.$keyword.'%');
                        })->paginate(15);
                    }
                } else {
                    if (! $request->user()->hasRole('admin')) {
                        $records = User::where('id', '!=', 2)->paginate(15);
                    } else {
                        $records = User::paginate(15);
                    }
                }
                $response['success'] = true;
                $response['html'] = view('admin.users.list', ['records' => $records])->render();
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
    }

    public function store(Request $request)
    {
        // dd($request->hotel_id);
        $check = $this->check($request, 'create-user', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email:rfc,dns|unique:users,email',
                        'password' => 'required|min:8',
                        'role' => 'required',
                        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                        'hotel_id' => 'required|array|min:1',
                        'package_id' => 'required|array|min:1'
                    ]);
                if (! $validator->fails()) {
                    try {
                        $input = $request->all();
                        $input['password'] = bcrypt($input['password']);
                        $input['hotel_id'] = implode(',',$input['hotel_id']);
                        $input['package_id'] = implode(',',$input['package_id']);
                        $input['owner_id'] = Auth::user()->id;
                        $user = User::create($input);
                        if ($user) {
                            $addToUserRole = [];
                            $addToUserRole['user_id'] = $user->id;
                            $addToUserRole['role_id'] = $input['role'];

                            UserRoles::create($addToUserRole);
                        }
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
        // dd($request->hotel_id);
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = ['name' => 'required|alpha'];
                $validation_array = ['password' => 'required|min:8'];
                $validation_array = ['mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'];
                $validation_array = [ 'hotel_id' => 'required|array|min:1' ];
                $validation_array = [ 'package_id' => 'required|array|min:1' ];
               
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['confirmed']);
                    $update['password'] = bcrypt($update['password']);
                    $update['hotel_id'] = implode(',',$update['hotel_id']);
                    $update['package_id'] = implode(',',$update['package_id']);
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
            $user = User::where('id', $id)->update($update);
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
            $affectedRows = User::where('id', $id)->delete();
            RolePermission::where('role_id', $id)->delete();
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
