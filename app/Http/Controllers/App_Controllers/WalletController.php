<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserWallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function getwallet(){
        $id = Auth::id;
        $wallet = Userwallet::where('user_id',$id)->get();
        return response()->json($wallet, 200);
    }
    public function updatewallet(){
        $id = Auth::id;
        $wallet = Userwallet::where('user_id',$id);

        $request->validate([
            'wallet_amount' => 'required',
        ], [
            'wallet_amount.required' => 'wallet_amount is required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $customers->update($input);
    }

    public function commisionswallet(){

    }
}
