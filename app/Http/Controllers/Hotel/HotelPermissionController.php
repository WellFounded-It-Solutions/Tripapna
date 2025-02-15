<?php

namespace App\Http\Controllers\Hotel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HotelModule;
use App\Models\Hotelrole;
use App\Models\HotelRolePermission;
use Illuminate\Http\Request;

class HotelPermissionController extends Controller
{
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
        $this->check($request,'view');
        $page_name = 'Permission';

        return view('hotelpanel.permission.index', compact('page_name'));
    }

    public function get_list(Request $request)
    {
        if ($request->ajax()) {
            $records = Hotelrole::paginate(15);
            $response['success'] = true;
            $response['html'] = view('hotelpanel.permission.list', ['records' => $records])->render();
            $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

            return response()->json($response);
            exit;
        }
    }

    public function getPermission(Request $request, $id)
    {
        $moduleRecords = HotelModule::where('status', 'Active')->with(['permissions'])->get();
        $response['success'] = true;
        $response['html'] = view('hotelpanel.permission.friends', ['moduleRecords' => $moduleRecords, 'id' => $id])->render();

        return response()->json($response);
        exit;

        return response()->json($response);
        exit;
    }

    public function permission(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $affectedRows = HotelRolePermission::where('role_id', $input['id'])->delete();
            if (isset($input['permission'])) {
                foreach ($input['permission'] as $value) {
                    $insert = [];
                    $insert['role_id'] = $input['id'];
                    $insert['permission_id'] = $value;
                    $insert['hotel_id'] =  Auth::id();
                    HotelRolePermission::create($insert);
                }
            }
            $response['success'] = true;
            $response['message'] = 'Recored Store SuccessFully';
            $response['resetForm'] = true;
            $response['callBackFunction'] = 'permissionAddCallBack';

            return response()->json($response);
            exit;
        }
    }
}
