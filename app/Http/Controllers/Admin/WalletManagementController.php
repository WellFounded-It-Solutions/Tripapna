<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WalletManagementController extends Controller
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
        // Base query with join
        $query = DB::table('user_wallets')
            ->join('users', 'user_wallets.user_id', '=', 'users.id')
            ->select(
                'user_wallets.id',
                'user_wallets.user_id',
                'users.name',
                'users.email',
                'user_wallets.role',
                'user_wallets.wallet_amount',
                'user_wallets.updated_at'
            )
            ->orderBy('user_wallets.updated_at', 'desc');

        // Apply search filter if provided
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%")
                  ->orWhere('user_wallets.wallet_amount', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $wallets = $query->paginate(10);

        return view('admin.wallet', compact('wallets'));
    }

    /**
     * Process wallet payment.
     */
    public function pay(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // Fetch wallet
            $wallet = DB::table('user_wallets')->where('id', $id)->first();

            if (!$wallet) {
                return redirect()->back()->with('error', 'Wallet not found.');
            }

            // Check if wallet has sufficient balance
            if ($wallet->wallet_amount <= 0) {
                return redirect()->back()->with('error', 'Insufficient wallet balance.');
            }

            // Deduct the entire wallet amount
            $deductedAmount = $wallet->wallet_amount;
            DB::table('user_wallets')
                ->where('id', $id)
                ->update(['wallet_amount' => 0]);

            // Log the transaction (optional, commented out)
            // DB::table('transactions')->insert([
            //     'wallet_id' => $wallet->id,
            //     'amount' => $deductedAmount,
            //     'type' => 'deduction',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]);

            DB::commit();
            return redirect()->back()->with('success', "Successfully deducted {$deductedAmount} from wallet.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }
}
