<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modules;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $page_name = 'Permission';

        return view('admin.permission.index', compact('page_name'));
    }

    public function get_list(Request $request)
    {
        if ($request->ajax()) {
            $records = Role::paginate(15);
            $response['success'] = true;
            $response['html'] = view('admin.permission.list', ['records' => $records])->render();
            $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

            return response()->json($response);
            exit;
        }
    }

    public function getPermission(Request $request, $id)
    {
        $moduleRecords = Modules::where('status', 'Active')->with(['permissions'])->get();
        $response['success'] = true;
        $response['html'] = view('admin.permission.friends', ['moduleRecords' => $moduleRecords, 'id' => $id])->render();

        return response()->json($response);
        exit;

        return response()->json($response);
        exit;
    }

    public function permission(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $affectedRows = RolePermission::where('role_id', $input['id'])->delete();
            if (isset($input['permission'])) {
                foreach ($input['permission'] as $value) {
                    $insert = [];
                    $insert['role_id'] = $input['id'];
                    $insert['permission_id'] = $value;
                    RolePermission::create($insert);
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
