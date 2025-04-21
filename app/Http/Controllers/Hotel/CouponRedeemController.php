<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\PackageItem;
use App\Models\Coupon_Combinations;
use Illuminate\Http\Request;
use App\Models\HotelModulePermission;
use App\Models\HotelRolePermission;
use Illuminate\Support\Facades\Auth;
use Validator;
use function Safe\error_log;

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
			}
		}
		else
		{
			$response['success'] = false;
			$response['message'] = "You don't have permission";
		}
		return response()->json($response);
		
	}
	public function get_list(Request $request, $id=null)
	{
		$data = OrderDetails::where(['order_id' => $id])->get();
		$records = $data->map(function($record) {
			$package = $record->package_id;
			$coupon = $record->coupon_id;
			$hotel  = $record->hotel_id;
			$quantity = PackageItem::where('hotel_id', $hotel)->where('package_id', $package)->Where('coupon_id',$coupon)->first();
			$record->quantity = optional($quantity)->quantity ?? 0;
			return $record;
		});
		
		$response['success'] = true;
		$response['html'] = view('hotelpanel.coupon_redeem.coupon_details', ['records' => $records, 'id' => $id])->render();

		return response()->json($response);

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
			$user = OrderDetails::where('id', $id)->update(['status'=>'Redeem']);
			$response['success'] = true;
			$response['message'] = 'Status Changed SuccessFully';
			$response['data'] = $user;
		}else{
			$response['success'] = false;
			$response['message'] = "You don't have permission";
		}
		return response()->json($response);
	
	}
	public function change_status_multiple(Request $request)
	{
		$check = $this->check($request, 'cr-reedem', 'ajax');
		$row_check = $request->input('row-check');
		
		
		if ($check && !empty($row_check)) {
			$couponIds = [];
			$orderData = [];

			$decodedFirst = json_decode($row_check[0], true);
			$package_id = $decodedFirst['package_id'];
			
			// Step 1: Decode input and collect coupon_ids and corresponding order ids
			foreach ($row_check as $item) {
				$decoded = json_decode($item, true);
				$orderData[] = $decoded;
				$couponIds[] = $decoded['coupon_id'];
				
			}
	
			// Step 2: Check every pair for conflicts using the CouponCombinations model
			for ($i = 0; $i < count($couponIds); $i++) {
				for ($j = $i + 1; $j < count($couponIds); $j++) {
					$id1 = $couponIds[$i];
					$id2 = $couponIds[$j];
	
					$conflict = Coupon_Combinations::where('package_id',$package_id)->where(function ($query) use ($id1, $id2) {
							$query->where('coupon_id', $id1)
								  ->where('cannot_combine_id', $id2);
						})
						->orWhere(function ($query) use ($id1, $id2) {
							$query->where('coupon_id', $id2)
								  ->where('cannot_combine_id', $id1);
						})
						->exists();
	
					if ($conflict) {
						return redirect()->back()->withErrors([
							'error' => 'Please change your selections. Some selected coupons cannot be combined.'
						]);
					}
				}
			}
	
			// Step 3: No conflicts — update status
			foreach ($orderData as $data) {
				OrderDetails::where('id', $data['id'])->update([
					'status' => 'Redeem'
				]);
			}
	
			return redirect()->back()->with('success', 'Status changed successfully for all selected orders.');
		}
	
		return redirect()->back()->withErrors([
			'error' => "You don't have permission or no items selected."
		]);
	}
	
}
