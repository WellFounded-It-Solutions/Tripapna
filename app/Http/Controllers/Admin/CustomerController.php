<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
        $check = $this->check($request, 'view-customer', 'view');
        if ($check) {
            $page_name = 'Customer List';

            return view('customer.index', compact('page_name'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-customer', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $keyword = $_GET['title'];
                    $records = Customer::search($keyword)->paginate(15);
                } else {
                    $records = Customer::paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('customer.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function change_status(Request $request, $id, $status)
    {
        $check = $this->check($request, 'ai-customer', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Customer::find($id)->update($update);
            $response['success'] = true;
            $response['message'] = 'Status Changed SuccessFully';
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }
}
