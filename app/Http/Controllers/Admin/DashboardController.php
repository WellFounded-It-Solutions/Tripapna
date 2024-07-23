<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        $cumstomer_count = \App\Models\Customer::where('status', 'Active')->count();
        $hotel_count = \App\Models\Hotel::where('status', 'Active')->count();
        $package_count = \App\Models\Package::where('status', 'Active')->count();
        $hotelCoupon_count = \App\Models\HotelCoupon::where('status', 'Active')->count();
        $latest_hotel = \App\Models\Hotel::where('status', 'Active')->latest('id')->limit('8')->get();
        $order_list = \App\Models\Order::latest('id')->limit('10')->get();
        $todaySale  = \App\Models\Order::whereDate('created_at', Carbon::today())->sum('amount');
        $weeksale  = \App\Models\Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $monthlysale  = \App\Models\Order::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $yearlysale  = \App\Models\Order::whereYear('created_at', Carbon::now()->year)->sum('amount');
        return view('admin.dashboard.index',compact('cumstomer_count','hotel_count','package_count','hotelCoupon_count','latest_hotel','order_list','todaySale','weeksale','monthlysale','yearlysale'));
    }
}
