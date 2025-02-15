<?php
namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Models\hotelImages;
use App\Models\HotelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class PaymentController extends Controller
{
    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-hotel', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $records = Hotel::where(function ($query) {
                        $keyword = $_GET['title'];
                        $query->where('name', 'like', '%'.$keyword.'%')
                        ->orWhere('location', 'like', '%'.$keyword.'%');
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
}