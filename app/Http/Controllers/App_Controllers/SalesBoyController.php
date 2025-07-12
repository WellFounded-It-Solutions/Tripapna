<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesBoyController extends Controller
{
    public function getOffers()
    {
        try {
            $offers = SalesBoyOffer::where('status', 'active')->get();
            return response()->json([
                'success' => true,
                'data' => $offers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sales boy offers: ' . $e->getMessage()
            ], 500);
        }
    }
}