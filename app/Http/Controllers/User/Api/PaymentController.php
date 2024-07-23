<?php
namespace App\Http\Controllers\Api;
use App\Models\Hotel;
use App\Models\hotelImages;
use App\Models\HotelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class PaymentController extends Controller
{
    public function phone_redirect_url(Request $request)
    {
       echo 'here';die();
    }
}