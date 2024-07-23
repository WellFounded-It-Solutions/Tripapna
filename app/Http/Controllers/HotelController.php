<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\hotelImages;
use App\Models\HotelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class HotelController extends Controller
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
        $check = $this->check($request, 'view-hotel', 'view');
        if ($check) {
            $page_name = 'Hotels';
            $hotel_category = HotelCategory::where('status', 'Active')->get();
            return view('hotels.index', compact('page_name', 'hotel_category'));
        }
    }
    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-hotel', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = Hotel::where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('location', 'like', '%' . $keyword . '%');
                    })->paginate(15);
                } else {
                    $records = Hotel::paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotels.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();
                return response()->json($response);
                exit;
            }
        }
    }
    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-hotel', 'ajax');
        if ($check) {
            $record = Hotel::where(['id' => $id])->first();
            if (!empty($record)) {
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
        $check = $this->check($request, 'create-hotel', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validation_array = [
                    'name' => 'required',
                    'location' => 'required',
                    'hotel_category' => 'required',
                    'email' => 'required|email:rfc,dns|unique:users,email',
                    'password' => 'required|min:8',
                    'lat' => 'required',
                    'long' => 'required',
                    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'filenames' => 'required',
                    'filenames.*' => 'image'
                ];
                if ($input['type'] == 'c') {
                    $validation_array['amount'] = 'required';
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (!$validator->fails()) {
                    try {
                        $input['password'] = bcrypt($input['password']);
                        unset($input['confirmed']);
                        unset($input['filenames']);
                        $input['owner_id'] = Auth::user()->id;
                        $imageName = time() . '.' . $request->logo->extension();
                        $request->logo->move(public_path('logo'), $imageName);
                        $input['logo'] = $imageName;
                        //  pr($input); die;
                        $user = Hotel::create($input);
                        if ($request->hasfile('filenames')) {
                            foreach ($request->file('filenames') as $file) {
                                $name = time() . rand(1, 50) . '.' . $file->extension();
                                $file->move(public_path('hotelimages'), $name);
                                $create = array();
                                $create['hotel_id'] = $user->id;
                                $create['images'] = $name;
                                hotelImages::create($create);
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
                        $html .= '<li>' . $value['0'] . '</li>';
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
        $check = $this->check($request, 'edit-hotel', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = [
                    'name' => 'required',
                    'hotel_category' => 'required',
                    'location' => 'required',
                    'lat' => 'required',
                    'long' => 'required',
                    'email' => 'required|email:rfc,dns|unique:users,email',
                    //  'password' => 'required|min:8',
                    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ];
                if ($update['type'] == 'c') {
                    $validation_array['amount'] = 'required';
                }
                if ($request->hasFile('logo')) {
                    $validation_array['logo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                }
                if ($request->has('password') && !empty($request->input('password'))) {
                    $validation_array['password'] = 'required|min:8';
                }
                $validator = Validator::make($request->all(), $validation_array);
                if (!$validator->fails()) {
                    unset($update['_token']);
                    unset($update['confirmed']);
                    unset($update['filenames']);
                    unset($update['logo']);
                    if ($request->has('password') && !empty($request->input('password'))) {
                        $update['password'] = bcrypt($update['password']);
                    }
                    if ($request->hasFile('logo')) {
                        $imageName = time() . '.' . $request->logo->extension();
                        $request->logo->move(public_path('logo'), $imageName);
                        $update['logo'] = $imageName;
                    }
                    $user = Hotel::where('id', $update['id'])->update($update);
                    if ($request->hasfile('filenames')) {
                        hotelImages::where('hotel_id', $update['id'])->delete();
                        foreach ($request->file('filenames') as $file) {
                            $name = time() . rand(1, 50) . '.' . $file->extension();
                            $file->move(public_path('hotelimages'), $name);
                            $create = array();
                            $create['hotel_id'] = $update['id'];
                            $create['images'] = $name;
                            hotelImages::create($create);
                        }
                    }
                    $response['success'] = true;
                    $response['message'] = 'Records Updated SuccessFully';
                    $response['callBackFunction'] = 'updatedCallback';
                } else {
                    $response['success'] = false;
                    $html = "<ol type='1'>";
                    foreach ($validator->errors()->toarray() as $value) {
                        $html .= '<li>' . $value['0'] . '</li>';
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
        $check = $this->check($request, 'ai-hotel', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Hotel::where('id', $id)->update($update);
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
        $check = $this->check($request, 'delete-hotel', 'ajax');
        if ($check) {
            $affectedRows = Hotel::where('id', $id)->delete();
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
    public function unlink($image)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $this->destination_image_path . $image);
    }

    public function create_hotel_category(Request $request)
    {

        $check = $this->check($request, 'view-hotel-category', 'view');
        if ($check) {

            $page_name = 'Hotel Categories';
            return view('hotelCategory.create' , compact('page_name'));
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }
        return response()->json($response);
        exit;
    }

    public function store_hotel_category(Request $request)
    {
        $check = $this->check($request, 'create-hotel-category', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validation_array = [
                    'title' => 'required'
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (!$validator->fails()) {
                    HotelCategory::create($input);
                    $response['success'] = true;
                    $response['message'] = 'Records Created SuccessFully';
                    $response['callBackFunction'] = 'createdCallback';
                } else {
                    $response['success'] = false;
                    $html = "<ol type='1'>";
                    foreach ($validator->errors()->toarray() as $value) {
                        $html .= '<li>' . $value['0'] . '</li>';
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

    public function get_hotel_category_list(Request $request)
    {
        $check = $this->check($request, 'view-hotel-category', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = HotelCategory::where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('title', 'like', '%' . $keyword . '%');
                    })->paginate(15);
                } else {
                    $records = HotelCategory::paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('hotelCategory.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();
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

}
