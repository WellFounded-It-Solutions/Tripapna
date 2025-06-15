<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Get the user's wallet.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $id = $request->input('id');
    
        $wallet = UserWallet::where('user_id', $id)->get();

        return response()->json($wallet, 200);
    }

    /**
     * Increase the user's wallet amount.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
    $id = $request->input('id');
    
        // Validate input
        $request->validate([
            'wallet_amount' => 'required|numeric',
        ], [
            'wallet_amount.required' => 'Wallet amount is required',
            'wallet_amount.numeric' => 'Wallet amount must be a number',
        ]);

        try {
            // Fetch user wallet entry
            $wallet = UserWallet::where('user_id', $id)->firstOrFail();

            // Calculate new wallet amount
            $newAmount = $wallet->wallet_amount + $request->wallet_amount;

            // Optional: Prevent negative balance
            if ($newAmount < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient wallet balance',
                ], 400);
            }

            // Update wallet
            $wallet->update(['wallet_amount' => $newAmount]);

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

    /**
     * Add a new wallet for a user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:user_wallets,user_id',
            'role' => 'required|integer',
            'wallet_amount' => 'nullable|numeric|min:0',
        ], [
            'user_id.required' => 'User ID is required',
            'user_id.exists' => 'User does not exist',
            'user_id.unique' => 'A wallet already exists for this user',
            'role.required' => 'Role is required',
            'role.integer' => 'Role must be an integer',
            'wallet_amount.numeric' => 'Wallet amount must be a number',
            'wallet_amount.min' => 'Wallet amount cannot be negative',
        ]);

        try {
            // Create new wallet
            $wallet = UserWallet::create([
                'user_id' => $request->user_id,
                'role' => $request->role,
                'wallet_amount' => $request->wallet_amount ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Wallet created successfully',
                'wallet' => $wallet,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create wallet',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Placeholder for commissions wallet functionality.
     *
     * @return void
     */
    public function commisionswallet()
    {
        // TODO: Implement commissions wallet logic
    }
}