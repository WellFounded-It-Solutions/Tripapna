<?php

namespace App\Http\Controllers\Hotel;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HotelPanelDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 
        $package_sold_count = \App\Models\OrderPackageDetails::where('hotel_id',  $userId)->groupBy('package_id')->count();
        $coupon_sold_count = \App\Models\OrderDetails::where('hotel_id',  $userId)->where('type','Coupon')->count();
        $coupon_count = \App\Models\HotelCoupon::where('hotel_id',  $userId)->count();
        $records =  \App\Models\OrderPackageDetails::where('hotel_id',  $userId)->groupBy('package_id')->orderBy('id','DESC')->limit(8)->get();
        return view('hotelpanel.dashboard',compact('package_sold_count','coupon_sold_count','coupon_count','records'));
    }
}
