<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class FakeController extends Controller
{
    //
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
            $page_name = 'Fake Orders';

            return view('fakeorders.index', compact('page_name'));
        }
    }
    public function new(Request $request)
    {
        $check = $this->check($request, 'view-orders', 'view');
        if ($check) {
            $page_name = 'Package';
            // $hotelRecord = Hotel::where('status', 'Active')->get();
            // $couponRecord = Coupon::where('status', 'Active')->get();
            // $Categories = Categories::where('status', 'Active')->get();

            return view('fakeorders.addpackage');
        }
    }
}
