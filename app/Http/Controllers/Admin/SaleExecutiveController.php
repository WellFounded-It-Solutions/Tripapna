<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SaleExecutive;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Invite;
use App\Models\Package;
use App\Models\UserRoles;
use App\Models\UserWallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class SaleExecutiveController extends Controller
{
    public function index(request $request)
    {
        $manager = Auth::user()->id;
        $salesExecutives = User::where('parent_id',$manager)->get();
        return view('admin.sales_executives.index', compact('salesExecutives'));
    }
    public function assignHotel()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        $managerId = Auth::id();
        $assignData = Hotel::select('name','email','location')->where(['manager_id'=> $managerId,'status'=>'Active'])->get();

        return view('admin.sales_executives.assign_hotel', compact('assignData'));
    }

    public function create()
    {
        $assignPackage = Package::select('id','title')->where('status','Active')->get();

        return view('admin.sales_executives.create',compact('assignPackage'));
    }
public function create_offer(){
        $manager = Auth::user()->id;
    $assignedUsers = User::select('package_id', 'id', 'name')
        ->where('maneger_id', $manager)
        ->get();

    foreach ($assignedUsers as $user) {
        $packageIds = collect(explode(',', $user->package_id))
            ->map(fn($id) => trim($id))       // Remove whitespace
            ->filter(fn($id) => is_numeric($id)) // Remove any non-numeric values
            ->all();

        $packageTitles = Package::whereIn('id', $packageIds)->pluck('title')->toArray();
        $user->package_titles =  $packageTitles;// if you want a string
    }

    return view('admin.sales_executives.offer_sales', [
        'assignedPackages' => $assignedUsers
    ]);
}
  public function track_sales(Request $request)
{
    $salesId = $request->sales_id;

    $query = Invite::select(
            'invite_link.id as invite_id',
            'invite_link.status as invite_status',
            'invite_link.sales_id as invite_sales_id',
            'carts.id as cart_id',
            'carts.amount as cart_amount',
            'carts.qty as cart_qty',
            'carts.type as cart_type',
            'customers.id as customer_id',
            'customers.name as customer_name',
            'customers.email as customer_email',
            'customers.mobile as customer_mobile',
            'customers.address as customer_address'
        )
        ->join('carts', 'invite_link.cart_id', '=', 'carts.id')
        ->join('customers', 'carts.customer_id', '=', 'customers.id');

    // Only filter by sales_id if it's present
    if ($salesId) {
        $query->where('invite_link.sales_id', $salesId);
    }

    $invites = $query->get();
        return view('admin.sales_executives.track_sales',compact('invites'));
}

  public function payment(Request $request)
    {
        // Get the logged-in manager
        $manager = Auth::user();

        // Base query with join
        $query = DB::table('users')
            ->leftJoin('user_wallets', 'users.id', '=', 'user_wallets.user_id')
            ->where('users.maneger_id', $manager->id)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'user_wallets.wallet_amount',
                'user_wallets.updated_at'
            )
            ->orderBy('user_wallets.updated_at', 'desc');

        // Apply search filter if provided
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $salesExecutives = $query->paginate(10);

        return view('admin.sales_executives.pay_sales', compact('salesExecutives'));
    }

    /**
     * Process wallet payment for a sales executive.
     */
    public function pay(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // Verify the sales executive is under the manager
            $manager = Auth::user();
            $salesExecutive = DB::table('users')
                ->where('maneger_id', $manager->id)
                ->where('id', $id)
                ->select('id', 'name')
                ->first();

            if (!$salesExecutive) {
                return redirect()->back()->with('error', 'Sales executive not found or not under your management.');
            }

            // Fetch the wallet
            $wallet = DB::table('user_wallets')
                ->where('user_id', $salesExecutive->id)
                ->first();

            if (!$wallet) {
                return redirect()->back()->with('error', 'Wallet not found for this sales executive.');
            }

            // Check if wallet has sufficient balance
            if ($wallet->wallet_amount <= 0) {
                return redirect()->back()->with('error', 'Insufficient wallet balance.');
            }

            // Deduct the entire wallet amount
            $deductedAmount = $wallet->wallet_amount;
            DB::table('user_wallets')
                ->where('user_id', $salesExecutive->id)
                ->update([
                    'wallet_amount' => 0,
                    'updated_at' => now(),
                ]);

            // Log the transaction (assuming a transactions table exists)
            // You may need to adjust this based on your actual transaction table
            // DB::table('transactions')->insert([
            //     'wallet_id' => $wallet->id,
            //     'amount' => $deductedAmount,
            //     'type' => 'deduction',
            //     'created_at' => now(),
            // ]);

            DB::commit();
            return redirect()->back()->with('success', "Successfully deducted {$deductedAmount} from {$salesExecutive->name}'s wallet.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'age' => 'required|integer',
            'mobile' => 'required',
            // 'id_proof' => 'required',
        ]);
        $managerid = Auth::user()->id;
        error_log($managerid);
        // dd($managerid);
        $agent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'address' => $request->address,
            'status' => 'Active',
            'mobile' => $request->mobile,
            'parent_id' => $managerid,
            'maneger_id' => $managerid,
            'role' => '7',
            'pay_status' => $request->pay_status,
            'id_proof' => $request->id_proof,
            'package_id' => implode(',',$request->package_id)

        ]);
        UserRoles::insert([
            'user_id' => $agent->id, 
            'role_id' => '7', 
        ]);
        UserWallet::create([
            'user_id' => $agent->id,
            'role'=> '7',
            'wallet_amount' => 0
        ]);


        return redirect()->route('sales_executives.index')
                         ->with('success', 'Sales Executive created successfully.');
    }

    public function show($id)
    {
        $salesExecutive = User::where('id', $id)->first();
        // $assignPackage = Package::select('id','title')->where('status','Active')->get();
        $assignPackage = Package::all(); // Fetch packages from the database
        $selectedPackages = explode(',', $salesExecutive->package_id);
        return view('admin.sales_executives.edit', compact('salesExecutive','assignPackage','selectedPackages'));
    }

    // public function edit($id)
    // {
    //     $salesExecutive = User::where('id', $id)->first();
    //     return view('admin.sales_executives.edit', compact('salesExecutive'));
    // }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        // $salesExecutive->update($request->all());
        User::where('id', $id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'id_proof' => $request->id_proof,
            'pay_status' => $request->pay_status,
            'package_id' => implode(',', $request->package_id)
        ]);

        return redirect()->route('sales_executives.index')
                         ->with('success', 'Sales Executive updated successfully.');
    }
    

    public function destroy(SalesExecutive $salesExecutive)
    {
        $salesExecutive->delete();

        return redirect()->route('sales_executives.index')
                         ->with('success', 'Sales Executive deleted successfully.');
    }
}
