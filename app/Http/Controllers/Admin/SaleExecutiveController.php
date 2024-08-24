<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SaleExecutive;
use App\Models\User;
use App\Models\Hotel;
use App\Models\UserRoles;
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
        return view('admin.sales_executives.create');
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
        $agent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'address' => $request->address,
            'status' => 'Active',
            'mobile' => $request->mobile,
            'parent_id' => $managerid,
            'role' => '7',
            'pay_status' => 'COD',
            'id_proof' => $request->id_proof
        ]);
        UserRoles::insert([
            'user_id' => $agent->id, 
            'role_id' => '7', 
        ]);

        return redirect()->route('sales_executives.index')
                         ->with('success', 'Sales Executive created successfully.');
    }

    public function show($id)
    {
        $salesExecutive = User::where('id', $id)->first();
        return view('admin.sales_executives.edit', compact('salesExecutive'));
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
            'pay_status' => 'COD'
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
