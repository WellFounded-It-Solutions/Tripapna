<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday_Package;

class HolidayPackageController extends Controller
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
        $page_name = 'Holiday Package';
        
        $query = Holiday_Package::query();
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        $packages = $query->latest()->get();

        return view('holidaypackage.index', compact('page_name', 'packages'));
    }
    public function addHoliday(Request $request){
        
    }
}
//Holiday Package
//Testing the invite
//Wallet Management
//Fake Orders 