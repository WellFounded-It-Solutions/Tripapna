<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
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
        $check = $this->check($request, 'view-orders', 'view');
        if ($check) {
            $page_name = 'Orders';

            return view('order.index', compact('page_name'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-orders', 'ajax');
        if ($check)
        {
            if ($request->ajax())
            {
                if ($request->title != '')
                {
                    $keyword = $_GET['title'];
                    $records = Order::search($keyword)->orderBy('id','DESC')->paginate(15);
                }
                else
                {
                    $records = Order::orderBy('id','DESC')->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('order.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function details(Request $request, $id)
    {
        $check = $this->check($request, 'view-orders', 'ajax');
        if ($check) {
            $record = Order::where(['id' => $id])->with(['orderPackageDetails'])->first();
            if (! empty($record)) {
                $response['html'] = view('order.details', ['records' => $record])->render();
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
