<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CouponController extends Controller
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
        $check = $this->check($request, 'view-coupons', 'view');
        if ($check) {
            $category = Categories::where('status', 'Active')->get();
            $page_name = 'Coupon';

            return view('coupon.index', compact('page_name', 'category'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-coupons', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = Coupon::with('category')->where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('title', 'like', '%'.$keyword.'%')
                            ->orWhere('custom_coupon_id', 'like', '%'.$keyword.'%');
                    })->paginate(15);
                } else {
                    $records = Coupon::with('category')->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('coupon.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-categories', 'ajax');
        if ($check) {
            $record = Coupon::where(['id' => $id])->first();
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
        $check = $this->check($request, 'add-coupon', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validation_array = [
                    'title' => 'required',
                    'category_id' => 'required',
                    'description' => 'required',
                    'visit_type' => 'required',
                    'note'=>'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        unset($input['files']);
                        $input['owner_id'] = Auth::user()->id;
                        $input['custom_coupon_id'] = couponCode();
                        if ($request->hasFile('image') ) {
                            $imageName = time().'.'.$request->image->extension();
                            $request->image->move(public_path('coupon'), $imageName);
                            $input['image'] = $imageName;
                        }
                        $user = Coupon::create($input);
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
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function update(Request $request)
    {
        $check = $this->check($request, 'edit-coupon', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = [
                    'title' => 'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['files']);
                    
                    unset($update['image']);
                    if ($request->hasFile('image') ) {
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('coupon'), $imageName);
                        $update['image'] = $imageName;
                    }
                    $user = Coupon::where('id', $update['id'])->update($update);
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
        $check = $this->check($request, 'ai-coupon', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Coupon::where('id', $id)->update($update);
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
        $check = $this->check($request, 'delete-coupon', 'ajax');
        if ($check) {
            $affectedRows = Coupon::where('id', $id)->delete();
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
