<?php
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\HotelCoupon;
use App\Models\PackageItem;
use App\Models\Hotelrole;
use App\Models\Role;
use App\Models\Order;
use App\Models\RolePermission;
use App\Models\HotelRolePermission;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderPackageDetails;
use App\Models\Categories;
if (! function_exists('pr')) {
    function pr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}
function json_output($data, $die = true)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    if ($die) {
        exit;
    }
}
function get_roles($params)
{
    if ($params == 'administrator') {
        return Role::where('admin_can_see', 1)->get();
    } elseif ($params == 'subadmin') {
        return Role::where('sub_admin_can_see', 1)->get();
    } elseif ($params == 'manager') {
        return Role::where('maneger_can_see', 1)->get();
    } elseif ($params == 'agent') {
        return Role::where('agent_can_see', 1)->get();
    }
}
function get_rolesHotel()
{
    return Hotelrole::where('id','2')->get();
}
function checkPermission($rid, $pid)
{
    return RolePermission::where('role_id', $rid)->where('permission_id', $pid)->count();
}
function checkPermissionforhotel($rid, $pid,$hotel_id)
{
    return HotelRolePermission::where('role_id', $rid)->where('permission_id', $pid)->where('hotel_id', $hotel_id)->count();
}
function couponCode()
{
    $latest = Coupon::withoutGlobalScopes()->orderBy('id', 'desc')->first();
    if (! $latest) {
        return 'COUPON0001';
    }
    $string = preg_replace("/[^0-9\.]/", '', $latest->custom_coupon_id);
    return 'COUPON'.sprintf('%04d', $string + 1);
}
function couponDetails($id)
{
    return  Coupon::where('id', $id)->first();
}
function couponHotelCode()
{
    $latest = HotelCoupon::latest()->first();
    if (! $latest) {
        return 'COUPONH0001';
    }
    $string = preg_replace("/[^0-9\.]/", '', $latest->custom_coupon_id);
    return 'COUPONH'.sprintf('%04d', $string + 1);
}
function getPackageDetails($id)
{
    return PackageItem::where('package_id', $id)->with(['hotel'])->first();
}
function getPackageDetailsWithCoupon($id,$hotelid = null)
{
   
    if($hotelid==NULL) {
        return PackageItem::where('package_id', $id)->get();
    }else{
           //echo $id;
         $hotelid = Auth::user()->id;
        return PackageItem::where('package_id', $id)->where('hotel_id',$hotelid)->get();
    }
}
function getPackageDetailsmultiple($id)
{
    return PackageItem::where('package_id', $id)->groupBy('hotel_id')->with(['hotel'])->get();
}
function getPackageDetailsmultiplecoupon($id, $hotelid)
{
    return PackageItem::where('package_id', $id)->where('hotel_id', $hotelid)->get();
}
function getorderDetails($id, $order_id)
{
    return OrderDetails::where('package_id', $id)->where('order_id', $order_id)->get();
}
function soldPackageCount($id)
{
    $hotelid = Auth::user()->id;
    return OrderPackageDetails::where('package_id', $id)->where('hotel_id', $hotelid)->count();
}
if (!function_exists('getOrders'))
{
    function getOrders($orderIds=null)
    {
        $order_id='';
        $order_data = Order::where('id',$orderIds)->get();
        $order_id = isset($data->order_id) ? $data->order_id:'';
        return $order_id;
    }
}
if (!function_exists('geSingleOrder'))
{
    function geSingleOrder($orderIds=null)
    {
        $user_name='';
        $order_data = Order::where('id',$orderIds)->first();
        return $order_data;
    }
}
if (!function_exists('getCouponCategory'))
{
    function getCouponCategory($id=null)
    {
        $order_data = Categories::where('id',$id)->first();
        return $order_data;
    }
}
