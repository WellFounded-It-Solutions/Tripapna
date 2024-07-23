<?php

namespace App\Http\Controllers\Hotel;
use App\Http\Controllers\Controller;
use App\Models\OrderPackageDetails;
use App\Models\Package;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HotelModulePermission;
use App\Models\HotelRolePermission;
use Validator;

class PackageController extends Controller
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
         $check = $this->check($request, 'sp-view', 'view');
         if ($check) {
                $page_name = 'Sold Package';
                return view('hotelpanel.package.index',compact('page_name'));
         }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'sp-view', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                $userId = Auth::id(); 
                    if($request->user()->role_id==2){
                    $userId = $request->user()->hotel_id;
                    }
                if ($request->title != '') {
                    $keyword = $_GET['title'];
                    $records = OrderPackageDetails::where('hotel_id',  $userId)->with(['packages'])->groupBy('package_id')->paginate(15);
                } else {
                    $records = OrderPackageDetails::where('hotel_id',  $userId)->with(['packages'])->groupBy('package_id')->paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotelpanel.package.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-single-package', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            $items = PackageItem::where(['package_id' => $id])->get();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
                $response['items'] = $items->toarray();
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
        $check = $this->check($request, 'add-single-package', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validation_array = [
                    'title' => 'required',
                    'hotel_id' => 'required',
                    'coupon' => 'required|array',
                    'limit' => 'required',
                    'term_conditions' => 'required',
                    'valid_date' => 'required',
                    'description' => 'required',
                    'description' => 'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        $input['title'] = $request->input('title');
                        $input['limit'] = $request->input('limit');
                        $input['term_conditions'] = $request->input('term_conditions');
                        $input['valid_date'] = $request->input('valid_date');
                        $input['description'] = $request->input('description');
                        $input['amount'] = $request->input('amount');
                        $input['owner_id'] = Auth::user()->id;
                        $package_created = Package::create($input);
                        if ($package_created) {
                            foreach ($request->input('coupon') as $key => $value) {
                                $inputitems['package_id'] = $package_created->id;
                                $inputitems['hotel_id'] = $request->input('hotel_id');
                                $inputitems['category_id'] = $request->input('category_id');
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
        $check = $this->check($request, 'edit-single-package', 'ajax');
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
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    unset($update['hotel_id']);
                    unset($update['coupon']);
                    $package_created = Package::find($update['id'])->update($update);
                    if ($package_created) {
                        $affectedRows = PackageItem::where('package_id', $update['id'])->delete();
                        foreach ($request->input('coupon') as $key => $value) {
                            $inputitems['package_id'] = $update['id'];
                            $inputitems['hotel_id'] = $request->input('hotel_id');
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
        $check = $this->check($request, 'ai-single-package', 'ajax');
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
        $check = $this->check($request, 'delete-single-package', 'ajax');
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
        $check = $this->check($request, 'sp-view', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            if (! empty($record)) {
                $response['html'] = view('hotelpanel.package.details', ['records' => $record])->render();
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
        $check = $this->check($request, 'clone-single-package', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $validation_array = [
                    'title' => 'required',
                    'hotel_id' => 'required',
                    'coupon' => 'required|array',
                    'limit' => 'required',
                    'term_conditions' => 'required',
                    'valid_date' => 'required',
                    'description' => 'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        $input['title'] = $request->input('title');
                        $input['limit'] = $request->input('limit');
                        $input['term_conditions'] = $request->input('term_conditions');
                        $input['valid_date'] = $request->input('valid_date');
                        $input['description'] = $request->input('description');
                        $input['amount'] = $request->input('amount');
                        $input['owner_id'] = Auth::user()->id;
                        $package_created = Package::create($input);
                        if ($package_created) {
                            foreach ($request->input('coupon') as $key => $value) {
                                $inputitems['package_id'] = $package_created->id;
                                $inputitems['hotel_id'] = $request->input('hotel_id');
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
        $check = $this->check($request, 'clone-single-package', 'ajax');
        if ($check) {
            $record = Package::where(['id' => $id])->first();
            $items = PackageItem::where(['package_id' => $id])->get();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
                $response['items'] = $items->toarray();
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
