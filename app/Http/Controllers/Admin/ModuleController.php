<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modules;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $page_name = 'Module';
        return view('admin.modules.index', compact('page_name'));
    }

    public function get_list(Request $request)
    {
        // $check = $this->check($request, 'view-module', 'ajax');
        if (1) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = Modules::where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })->paginate(15);
                } else {
                    $records = Modules::paginate(10);
                }
                $response['success'] = true;
                $response['html'] = view('admin.modules.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();
                return response()->json($response);
                exit;
            }
        }
    }

    public function store(Request $request)
    {
        // $check = $this->check($request, 'add-module', 'ajax');
        if (1) {
            if ($request->ajax()) {

                $this->validate($request, [
                    'title' => 'required',
                ]);

                $record = Modules::where('title', $request->title)->first();
                if (!empty($record)) {
                    $response['success'] = false;
                    $response['message'] = 'Module already exists.';
                    return response()->json($response);
                    exit;
                }

                $record = new Modules();
                $record->title = $request->title;
                $record->save();
                $response['success'] = true;
                $response['message'] = 'Module added successfully.';
                $response['callBackFunction'] = 'createdCallback';
                return response()->json($response);
                exit;
            }
        }
    }

    public function change_status(Request $request)
    {
        // $check = $this->check($request, 'change-module-status', 'ajax');
        if (1) {
            if ($request->ajax()) {
                $record = Modules::find($request->id);
                $record->status = $request->status;
                $record->save();
                $response['success'] = true;
                $response['message'] = 'Module status changed successfully.';
                return response()->json($response);
                exit;
            }
        }
    }
}
