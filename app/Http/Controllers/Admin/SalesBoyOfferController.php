<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesBoyOffer;

class SalesBoyOfferController extends Controller
{
    public function index()
    {
        $offers = SalesBoyOffer::all();
        return view('sales_boy_offers.index', compact('offers'));
    }

    public function create()
    {
        
        return view('sales_boy_offers.create',);
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer' => 'required|string',
            'commission' => 'required|numeric',
            'automatic_credit_commission' => 'boolean',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        SalesBoyOffer::create($request->all());
        return redirect()->route('sales_boy_offers.index')->with('success', 'Offer created successfully');
    }


}
