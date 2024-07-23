<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class multiplePackageController extends Controller
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
        $check = $this->check($request, 'view-multiple-package', 'view');
        if ($check) {
            $page_name = 'Package';
            $hotelRecord = Hotel::where('status', 'Active')->get();
            $Categories = Categories::where('status', 'Active')->get();
            $couponRecord = Coupon::where('status', 'Active')->get();

            return view('multiplepackage.index', compact('page_name', 'hotelRecord', 'Categories', 'couponRecord'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-multiple-package', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $keyword = $_GET['title'];
                    $records = Package::where('title', 'like', '%'.$keyword.'%')->where('type', 'multiple')->paginate(15);
                } else {
                    $records = Package::where('type', 'multiple')->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('multiplepackage.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-multiple-package', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            $items = PackageItem::where(['package_id' => $id])->get();
            $hotelRecord = Hotel::where('status', 'Active')->get();
            $Categories = Categories::where('status', 'Active')->get();
            $couponRecord = Coupon::where('status', 'Active')->get();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
                $response['items'] = $items->toarray();
                $response['html'] = view('multiplepackage.clone', ['items' => $items, 'hotelRecord' => $hotelRecord, 'Categories' => $Categories, 'couponRecord' => $couponRecord])->render();
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
        $check = $this->check($request, 'add-multiple-package', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validation_array = [
                    'title' => 'required',
                    'hotel_id' => 'required|array',
                    'coupon' => 'required|array',
                    'category_id' => 'required|array',
                    'limit' => 'required',
                    'term_conditions' => 'required',
                    'description' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ];
                if($request->input('expire_type')=="Fixed") {
                    $validation_array['valid_date'] = 'required';
                        $input['valid_date'] = $request->input('valid_date');
                }else{
                    $validation_array['variable_month'] = 'required';
                        $input['variable_month'] = $request->input('variable_month');
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        $input['title'] = $request->input('title');
                        $input['limit'] = $request->input('limit');
                        $input['term_conditions'] = $request->input('term_conditions');
                        $input['valid_date'] = $request->input('valid_date');
                        $input['description'] = $request->input('description');
                        $input['type'] = 'multiple';
                        if($request->has('discount')) {
                        $dis = $request->input('discount')*$request->input('amount')/100;
                        $input['amount'] = $request->input('amount') - $dis ;
                        $input['discount'] = $request->input('discount');
                        }else{
                        $input['amount'] = $request->input('amount');
                        }
                        $input['owner_id'] = Auth::user()->id;
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('package'), $imageName);
                        $input['image'] = $imageName;
                        $package_created = Package::create($input);
                        if ($package_created) {
                            foreach ($request->input('coupon') as $key => $value) {
                                $inputitems['package_id'] = $package_created->id;
                                $inputitems['hotel_id'] = $request->input('hotel_id')[$key];
                                $inputitems['category_id'] = $request->input('category_id')[$key];
                                $inputitems['coupon_id'] = $value;
                                PackageItem::create($inputitems);
                            }
                        }
                        $response['success'] = true;
                        $response['message'] = 'Recored Store SuccessFully';
                        $response['resetForm'] = true;
                        $response['callBackFunction'] = 'addCallBack';
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
        $check = $this->check($request, 'edit-multiple-package', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = [
                    'title' => 'required',
                    'hotel_id' => 'required',
                    'coupon' => 'required|array',
                    'limit' => 'required',
                    'term_conditions' => 'required',
                    'valid_date' => 'required',
                    'description' => 'required',
                ];
                if($request->input('expire_type')=="Fixed") {
                    $validation_array['valid_date'] = 'required';
                        $update['valid_date'] = $request->input('valid_date');
                }else{
                    $validation_array['variable_month'] = 'required';
                        $update['variable_month'] = $request->input('variable_month');
                }
                if ($request->hasFile('image') ) {
                     $validation_array['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['hotel_id']);
                    unset($update['coupon']);
                    unset($update['category_id']);
                    if ($request->hasFile('image') ) {
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('package'), $imageName);
                        $update['image'] = $imageName;
                    }
                    if($request->has('discount')) {
                        $dis = $request->input('discount')*$request->input('amount')/100;
                        $update['amount'] = $request->input('amount') - $dis ;
                        $update['discount'] = $request->input('discount');
                    }else{
                         $update['amount'] = $request->input('amount');
                    }
                    $package_created = Package::find($update['id'])->update($update);
                    if ($package_created) {
                        $affectedRows = PackageItem::where('package_id', $update['id'])->delete();
                        foreach ($request->input('coupon') as $key => $value) {
                            $inputitems['package_id'] = $update['id'];
                            $inputitems['hotel_id'] = $request->input('hotel_id')[$key];
                            $inputitems['category_id'] = $request->input('category_id')[$key];
                            $inputitems['coupon_id'] = $value;
                            PackageItem::create($inputitems);
                        }
                    }
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
        $check = $this->check($request, 'ai-multiple-package', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Package::find($id)->update($update);
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
        $check = $this->check($request, 'delete-multiple-package', 'ajax');
        if ($check) {
            $affectedRows = Package::find($id)->delete();
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

    public function details(Request $request, $id)
    {
        $check = $this->check($request, 'view-multiple-package', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            if (! empty($record)) {
                $response['html'] = view('multiplepackage.details', ['records' => $record])->render();
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

    public function unlink($image)
    {
        unlink($_SERVER['DOCUMENT_ROOT'].'/'.$this->destination_image_path.$image);
    }

    public function clone(Request $request)
    {
        $check = $this->check($request, 'clone-multiple-package', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validation_array = [
                    'title' => 'required',
                    'hotel_id' => 'required',
                    'coupon' => 'required|array',
                    'limit' => 'required',
                    'term_conditions' => 'required',
                    'description' => 'required',
                ];
                if($request->input('expire_type')=="Fixed") {
                    $validation_array['valid_date'] = 'required';
                     $input['valid_date'] = $request->input('valid_date');
                }else{
                    $validation_array['variable_month'] = 'required';
                     $input['variable_month'] = $request->input('variable_month');
                }
                if ($request->hasFile('image') ) {
                    $validation_array['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        $input['title'] = $request->input('title');
                        $input['limit'] = $request->input('limit');
                        $input['term_conditions'] = $request->input('term_conditions');
                        $input['description'] = $request->input('description');
                        $input['amount'] = $request->input('amount');
                        if($request->has('discount')) {
                        $dis = $request->input('discount')*$request->input('amount')/100;
                        $input['amount'] = $request->input('amount') - $dis ;
                        $input['discount'] = $request->input('discount');
                    }else{
                         $input['amount'] = $request->input('amount');
                    }
                        $input['type'] = 'multiple';
                        $input['owner_id'] = Auth::user()->id;
                        if ($request->hasFile('image') ) {
                            $imageName = time().'.'.$request->image->extension();
                            $request->image->move(public_path('package'), $imageName);
                            $input['image'] = $imageName;
                        }
                        $package_created = Package::create($input);
                        if ($package_created) {
                            foreach ($request->input('coupon') as $key => $value) {
                                $inputitems['package_id'] = $package_created->id;
                                $inputitems['hotel_id'] = $request->input('hotel_id')[$key];
                                $inputitems['category_id'] = $request->input('category_id')[$key];
                                $inputitems['coupon_id'] = $value;
                                PackageItem::create($inputitems);
                            }
                        }
                        $response['success'] = true;
                        $response['message'] = 'Recored Store SuccessFully';
                        $response['resetForm'] = true;
                        $response['callBackFunction'] = 'addCallBack';
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

    public function get_record_by_id_clone(Request $request, $id)
    {
        $check = $this->check($request, 'clone-multiple-package', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            $items = PackageItem::where(['package_id' => $id])->get();
            $hotelRecord = Hotel::where('status', 'Active')->get();
            $Categories = Categories::where('status', 'Active')->get();
            $couponRecord = Coupon::where('status', 'Active')->get();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
                $response['items'] = $items->toarray();
                $response['html'] = view('multiplepackage.clone', ['items' => $items, 'hotelRecord' => $hotelRecord, 'Categories' => $Categories, 'couponRecord' => $couponRecord])->render();
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

    public function getCoupon($cate_id)
    {
        $couponRecord = Coupon::where('status', 'Active')->where('category_id', $cate_id)->get();
        $html = '';
        foreach ($couponRecord as $value) {
            $html .= '<option value="'.$value->id.'">'.$value->title.'</option>';
        }
        $response['success'] = true;
        $response['html'] = $html;

        return response()->json($response);
    }
}
