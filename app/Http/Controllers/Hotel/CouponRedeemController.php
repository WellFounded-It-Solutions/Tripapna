<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Hotel;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\HotelModulePermission;
use App\Models\HotelRolePermission;
use Illuminate\Support\Facades\Auth;
use Validator;

class CouponRedeemController extends Controller
{
	 private function check($request, $module, $response_type)
	{
		$record = HotelModulePermission::select('id')->where('slug',$module)->first();
		$check = HotelRolePermission::where(['role_id'=>$request->user()->role_id,'permission_id'=>$record->id])->count();

		if($request->user()->role_id==2){
			$check = HotelRolePermission::where(['role_id'=>$request->user()->role_id,'permission_id'=>$record->id,'hotel_id'=>$request->user()->hotel_id])->count();
		}
		if ($check) {
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
		$this->check($request,'cr-view', 'view');
		$category = [];
		$page_name = 'Coupon';

		return view('hotelpanel.coupon_redeem.index', compact('page_name', 'category'));
	}
	public function orders(Request $request)
	{
		$check = $this->check($request,'cr-view', 'ajex');
		if($check)
		{
			if($request->ajax())
			{
				$userId = Auth::id();
				$records = OrderDetails::where('hotel_id', $userId)->orderBy('id','DESC')->groupBy('order_id')->paginate(15);
				$response['html'] = view('hotelpanel.coupon_redeem.list', ['records' => $records])->render();
				$response['pagination'] = view('admin.pagination', ['page' => $records])->render();
				return response()->json($response);
				exit;
			}
		}
		else
		{
			$response['success'] = false;
			$response['message'] = "You don't have permission";
		}
		return response()->json($response);
		exit;    
	}
	public function get_list(Request $request, $id=null)
	{
		$records = OrderDetails::where(['order_id' => $id])->get();
		$response['success'] = true;
		$response['html'] = view('hotelpanel.coupon_redeem.coupon_details', ['records' => $records, 'id' => $id])->render();

		return response()->json($response);
		exit;

		return response()->json($response);
		exit;
	}
	// public function get_list(Request $request)
	// {
	//     $check = $this->check($request,'cr-view', 'ajex');
	//     if($check)
	//     {
	//         if($request->ajax())
	//         {
	//             $userId = Auth::id();
	//             if($request->user()->role_id==2)
	//             {
	//                 $userId = $request->user()->hotel_id;
	//             }
	//             if ($request->coupon != '')
	//             {
	//                 $coupon = $_GET['coupon'];
	//                 $mobile = $_GET['mobile'];
	//                 $records = OrderDetails::where(['hotel_id' => $userId,'coupon'=>$coupon,'mobile_number'=>$mobile])->paginate(15);
	//             }
	//             else
	//             {
	//                 $records = OrderDetails::where('hotel_id', $userId)->orderBy('id','desc')->paginate(15);
	//             }
	//             $response['success'] = true;
	//             $response['html'] = view('hotelpanel.coupon_redeem.coupon_lists', ['records' => $records])->render();
	//             $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

	//             return response()->json($response);
	//             exit;
	//         }
	//     }
	//     else
	//     {
	//         $response['success'] = false;
	//         $response['message'] = "You don't have permission";
	//     }
	//     return response()->json($response);
	//     exit;    
	// }
	public function change_status(Request $request, $id, $status)
	{
		$check = $this->check($request, 'cr-reedem', 'ajax');
		if ($check) {
			$update['status'] = $status;
			$user = OrderDetails::where('id', $id)->update($update);
			$response['success'] = true;
			$response['message'] = 'Status Changed SuccessFully';
		}else{
			$response['success'] = false;
			$response['message'] = "You don't have permission";
		}    
		return response()->json($response);
		exit;
	}
	public function change_status_multiple(Request $request)
	{
		$check = $this->check($request, 'cr-reedem', 'ajax');
		$row_check = $request->input('row-check');
		if ($check && !empty($row_check)) {
			echo 'here';
			foreach($row_check as $key => $value) {
				$update['status'] = "Redeem";
				$user = OrderDetails::where('id', $value)->update($update);
			}
			$response['success'] = true;
			$response['message'] = 'Status Changed SuccessFully';
		}else{
			$response['success'] = false;
			$response['message'] = "You don't have permission";
		} 
		// return response()->json($response);
		// exit;   
	   return redirect()->back();
		exit;
	}
}