<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserWallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function get() {
    $id = Auth::id(); // Fixed Auth::id() usage
    $wallet = Userwallet::where('user_id', $id)->get();

    return response()->json($wallet, 200);
    }

public function update(Request $request) {
    $id = Auth::id(); // Fixed Auth::id() usage

    // Validate input
    $request->validate([
        'wallet_amount' => 'required|numeric',
    ], [
        'wallet_amount.required' => 'Wallet amount is required',
        'wallet_amount.numeric' => 'Wallet amount must be a number',
    ]);

    try {
        // Fetch user wallet entry
        $wallet = Userwallet::where('user_id', $id)->firstOrFail();

        // Update wallet
        $wallet->update(['wallet_amount' => $request->wallet_amount]);

        return response()->json([
            'success' => true,
            'message' => 'Wallet updated successfully',
            'wallet' => $wallet,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function commisionswallet(){

    }
}
