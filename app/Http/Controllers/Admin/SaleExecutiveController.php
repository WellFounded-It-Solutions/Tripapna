<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleExecutive;
use Illuminate\Http\Request;

class SaleExecutiveController extends Controller
{

    public function index()
    {
        $ExecutiveData = SaleExecutive::select('*')->latest()->get();
        // dd($data);
        return view('admin.sales_executives.index', compact('ExecutiveData'));
    }
    public function create()
    {
        return view('sales_executives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:sales_executives',
            'mobile' => 'required|string|max:15|unique:sales_executives',
            'address' => 'required|string',
            'id_proof' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        SalesExecutive::create($request->all());

        return redirect()->route('sales-executives.index')
                         ->with('success', 'Sales Executive created successfully.');
    }

    public function show(SalesExecutive $salesExecutive)
    {
        return view('sales_executives.show', compact('salesExecutive'));
    }

    public function edit(SalesExecutive $salesExecutive)
    {
        return view('sales_executives.edit', compact('salesExecutive'));
    }

    public function update(Request $request, SalesExecutive $salesExecutive)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:sales_executives,email,' . $salesExecutive->id,
            'mobile' => 'required|string|max:15|unique:sales_executives,mobile,' . $salesExecutive->id,
            'address' => 'required|string',
            'id_proof' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        $salesExecutive->update($request->all());

        return redirect()->route('sales-executives.index')
                         ->with('success', 'Sales Executive updated successfully.');
    }

    public function destroy(SalesExecutive $salesExecutive)
    {
        $salesExecutive->delete();

        return redirect()->route('sales-executives.index')
                         ->with('success', 'Sales Executive deleted successfully.');
    }

}