<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\HotelCoupon;
use App\Models\HotelModulePermission;
use App\Models\HotelRolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class HotelPanelCouponController extends Controller
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
        $this->check($request,'cm-view', 'view');
        $category = [];
        $page_name = 'Coupons';

        return view('hotelpanel.Coupon.index', compact('page_name', 'category'));
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request,'cm-view', 'ajex');
        if($check) {
            if ($request->ajax()) {
                $userId = Auth::id(); 
                if($request->user()->role_id==2){
                $userId = $request->user()->hotel_id;
                }
                if ($request->title != '') {
                    $records = HotelCoupon::where('hotel_id', $userId)->where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('title', 'like', '%'.$keyword.'%')
                            ->orWhere('custom_coupon_id', 'like', '%'.$keyword.'%');
                    })->paginate(15);
                } else {
                    $records = HotelCoupon::where('hotel_id', $userId)->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotelpanel.Coupon.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }else{
                      $response['success'] = false;
            $response['message'] = "You don't have permission"; 
                 return response()->json($response);
                exit; 
        }

    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'cm-edit', 'ajax');
        if ($check) {
            $record = HotelCoupon::where(['id' => $id])->first();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
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

    public function store(Request $request)
    {
         $check = $this->check($request, 'cm-add', 'ajax');
        if ($check) {         
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validation_array = [
                'title' => 'required',
                'description' => 'required',
                'visit_type' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $validator = Validator::make($request->all(), $validation_array);
            if (! $validator->fails()) {
                try {
                    unset($input['files']);
                    $input['hotel_id'] = Auth::user()->id;
                    $input['custom_coupon_id'] = couponHotelCode();
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('coupon'), $imageName);
                    $input['image'] = $imageName;
                    $user = HotelCoupon::create($input);
                    $response['success'] = true;
                    $response['message'] = 'Recored Store SuccessFully';
                    $response['resetForm'] = true;
                    $response['selfReload'] = true;
                } catch (exception $e) {
                    $response['success'] = false;
                    $response['message'] = 'There is some error please try after some time';
                }
            } else {
                $response['success'] = false;
                $html = "<ol type='1'>";
                foreach ($validator->errors()->toarray() as $value) {
                    $html .= '<li>'.$value['0'].'</li>';
                }
                $html .= '</ol>';
                $response['message'] = $html;
            }
        }
    }else{
             $response['success'] = false;
            $response['message'] = "You don't have permission";
    }

        return response()->json($response);
        exit;
    }

    public function update(Request $request)
    {
        $check = $this->check($request, 'cm-edit', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = [
                    'title' => 'required',
                ];
                if ($request->hasFile('image') ) {
                     $validation_array['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['files']);
                    if ($request->hasFile('image') ) {
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('coupon'), $imageName);
                        $update['image'] = $imageName;
                    }
                    $user = HotelCoupon::where('id', $update['id'])->update($update);
                    $response['success'] = true;
                    $response['message'] = 'Records Updated SuccessFully';
                    $response['callBackFunction'] = 'updatedCallback';
                } else {
                    $response['success'] = false;
                    $html = "<ol type='1'>";
                    foreach ($validator->errors()->toarray() as $value) {
                        $html .= '<li>'.$value['0'].'</li>';
                    }
                    $html .= '</ol>';
                    $response['message'] = $html;
                }

                return response()->json($response);
                exit;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function change_status(Request $request, $id, $status)
    {
        $check = $this->check($request, 'cm-ai', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = HotelCoupon::where('id', $id)->update($update);
            $response['success'] = true;
            $response['message'] = 'Status Changed SuccessFully';
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $check = $this->check($request, 'cm-delete', 'ajax');
        if ($check) {
            $affectedRows = HotelCoupon::where('id', $id)->delete();
            if ($affectedRows) {
                //$this->unlink($record->image);
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
