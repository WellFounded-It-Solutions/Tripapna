<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->query('title', '');
        $promocodes = PromoCode::where('promo_code', 'like', "%{$title}%")
            ->paginate(10);
        $page_name= "Promo Codes";

        return view('admin.promocode.index', compact('promocodes', 'title' , 'page_name'));
    }

    public function create()
    {
        return view('admin.promocode.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|unique:promocode,promo_code',
            'discount' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PromoCode::create([
            'promo_code' => $request->promo_code,
            'discount' => $request->discount
        ]);

        return redirect()->route('promocode_list')->with('success', 'Promo code created successfully.');
    }

    public function destroy($id)
    {
        $promocode = PromoCode::findOrFail($id);
        $promocode->delete();

        return redirect()->route('promocode_list')->with('success', 'Promo code deleted successfully.');
    }
}