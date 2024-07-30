<?php

namespace App\Http\Controllers\User;

use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\HotelCoupon;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['search', 'hotel_type', 'hotel_list', 'hotel_package', 'getCoupon', 'packages', 'packagesDetails']]);
    }

    public function index()
    {

        $mostPopularPackages = Package::where('status', "Active")->with(['PackageItem'])->OrderBy('id', 'DESC')->limit('4')->get();
        foreach ($mostPopularPackages as $v) {
            //   pr($v);
            $v->amount = " " . number_format($v->amount);
            $v->discount = $v->discount . " % Off";
            $v->rating = 4;
            foreach ($v->PackageItem as $key => $value) {
                $hlocation = Hotel::select('location')->where('id', $value->hotel_id)->first();
                $v->location = $hlocation->location;
                // $value->coupondata->image="a";
            }
            // $v->location="Jaipur,Delhi,Mumbai";
            foreach ($v->PackageItem as $key => $value) {
                $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
                $value->hoteldata = Hotel::where('id', $value->hotel_id)->first();
                // $value->coupondata->image="a";
            }
        }

        $HotelCoupons = HotelCoupon::where('status', 'Active')->with('hotel')->get();
        $HotelList = Hotel::where('status', 'Active')->with('images')->get();

        return view('user.home', compact('mostPopularPackages', 'HotelCoupons', 'HotelList'));
    }

    public function allStores()
    {

        $HotelList = Hotel::where('status', 'Active')->with('images')->get();

        return view('user.all-stores', compact('HotelList'));
    }

    public function storeDetails(Request $request, $id)
    {
        $search[] = ['status', 'Active'];
        $records = Package::where('status', 'Active')->whereHas('PackageItem', function ($query) use ($id) {
            $query->where('hotel_id', '=', $id);
        })->with(['PackageItem'])->get();
        foreach ($records as $v) {
            foreach ($v->PackageItem as $key => $value) {
                $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
            }
        }


        return view('user.store-details', compact('records'));
    }

    public function dealDetails(Request $request, $id)
    {
        $productdata = Package::where('status', 'Active')->where('id', $id)->with(['PackageItem'])->first();
        $productdata->amount = " " . number_format($productdata->amount);
        $productdata->discount = $productdata->discount . " % Off";
        $productdata->rating = 4;


        $couponCategories = $productdata->PackageItem->pluck('category_id')->toArray();
        $couponCategories = array_unique($couponCategories);
        $couponCategories = Categories::whereIn('id', $couponCategories)->get();


        foreach ($productdata->PackageItem as $key => $value) {
            $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
            $productdata->hotel = Hotel::select('location', 'mobile', 'lat', 'long', 'id')->where('id', $value->hotel_id)->with('images')->first();
        }

        return view('user.deal-details', compact('productdata' , 'couponCategories'));
    }



    // API's

    public function getCoupon(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $records = HotelCoupon::where('status', 'Active')->with('hotel')->get();
            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function packages(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            if ($request->has('type') && $request->input('type') == "latest") {
                $records = Package::where('status', 'Active')->with(['PackageItem'])->OrderBy('id', 'DESC')->limit('4')->get();
            } else if ($request->has('type') && $request->input('type') == "discount") {
                $records = Package::where('status', 'Active')->where('discount', '!=', 0)->with(['PackageItem'])->OrderBy('id', 'DESC')->limit('4')->get();
            } else if ($request->has('type') && $request->input('type') == "mostsold") {
                $records = Package::where('status', 'Active')->with(['PackageItem'])->OrderBy('sold_count', 'DESC')->limit('4')->get();
            } else {

                $records = Package::where('status', 'Active')->with(['PackageItem'])->get();
            }
            foreach ($records as $v) {
                //   pr($v);
                $v->amount = " " . number_format($v->amount);
                $v->discount = $v->discount . " % Off";
                $v->rating = 4;
                foreach ($v->PackageItem as $key => $value) {
                    $hlocation = Hotel::select('location')->where('id', $value->hotel_id)->first();
                    $v->location = $hlocation->location;
                    // $value->coupondata->image="a";
                }
                // $v->location="Jaipur,Delhi,Mumbai";
                foreach ($v->PackageItem as $key => $value) {
                    $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
                    $value->hoteldata = Hotel::where('id', $value->hotel_id)->first();
                    // $value->coupondata->image="a";
                }
            }
            if (!empty($records)) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function search(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $search = [];
            $search[] = ['status', 'Active'];
            if ($request->input('location') != '' && $request->input('hotel_category') != '') {
                $search[] = ['location', 'like', '%' . $request->input('location') . '%'];
                $search[] = ['hotel_category', $request->input('hotel_category')];
            }
            if ($request->input('hotel_category') != '') {
                $search[] = ['hotel_category', $request->input('hotel_category')];
            }
            if ($request->input('location') != '') {
                $search[] = ['location', 'like', '%' . $request->input('location') . '%'];
            }
            $records = Hotel::where($search)->get();
            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function hotel_type(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $search = [];
            $search[] = ['status', 'Active'];
            $records = HotelCategory::where($search)->get();
            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function hotel_list(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        try {
            $auth = Auth::user();
            $search = [];
            $search[] = ['status', 'Active'];
            if ($request->input('location') != '' && $request->input('hotel_category') != '') {
                $search[] = ['location', 'like', '%' . $request->input('location') . '%'];
                $search[] = ['hotel_category', $request->input('hotel_category')];
            }
            if ($request->input('hotel_category') != '') {
                $search[] = ['hotel_category', $request->input('hotel_category')];
            }
            if ($request->input('location') != '') {
                $search[] = ['location', 'like', '%' . $request->input('location') . '%'];
            }
            $records = Hotel::where($search)->with('images')->get();

            // foreach($records as $val){
            //      foreach($val as $v){
            //          $v->images = env('ADMIN_PATH').'hotelimages/'.$v->images;
            //      }
            // }
            if ($records) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function hotel_package(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $search[] = ['status', 'Active'];
            $records = Package::where('status', 'Active')->whereHas('PackageItem', function ($query) use ($request) {
                $query->where('hotel_id', '=', $request->input('hotel_id'));
            })->with(['PackageItem'])->get();
            foreach ($records as $v) {
                foreach ($v->PackageItem as $key => $value) {
                    $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
                }
            }
            if ($records) {
                $success = true;
                $data = $records;
                $message = __('api.home.record_not_found');
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.cart.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }
    public function getCouponDetails(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $auth = Auth::user();
            $records = HotelCoupon::where('status', 'Active')->where('id', $request->input('coupon_id'))->with('hotel')->first();
            if ($records != null) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }

    public function packagesDetails(Request $request)
    {
        $success = false;
        $message = '';
        $data = null;
        $validator = Validator::make($request->all(), [
            'package_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try {
            $auth = Auth::user();
            $records = Package::where('status', 'Active')->where('id', $request->input('package_id'))->with(['PackageItem'])->first();
            $records->amount = " " . number_format($records->amount);
            $records->discount = $records->discount . " % Off";
            foreach ($records->PackageItem as $key => $value) {
                $value->coupondata = Coupon::where('id', $value->coupon_id)->first();
                $records->rating = 4;
                $records->hotel = Hotel::select('location', 'mobile', 'lat', 'long', 'id')->where('id', $value->hotel_id)->with('images')->first();
            }

            if ($records != null) {
                $success = true;
                $data = $records;
            } else {
                $success = false;
                $message = __('api.home.record_not_found');
            }
        } catch (Exception $e) {
            $success = false;
            $message = __('api.home.fail');
        }
        $response['success'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;

        return response()->json($response, 200);
    }
}
