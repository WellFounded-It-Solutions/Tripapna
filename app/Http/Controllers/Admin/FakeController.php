<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FakeOrdersImport;

class FakeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->can('view-orders')) {
            abort(404);
        }
        return view('fakeorders.index', ['page_name' => 'Fake Orders']);
    }

    public function create()
    {
        $packages = DB::table('packages')->select('id', 'title')->get();
        $hotels = DB::table('hotels')->select('id', 'name')->get();
        return view('fakeorders.create', [
            'page_name' => 'Create Fake Order',
            'packages' => $packages,
            'hotels' => $hotels
        ]);
    }

    public function importForm()
    {
        return view('fakeorders.import', ['page_name' => 'Import Fake Orders']);
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Excel::import(new FakeOrdersImport, $request->file('file'));
            return redirect()->route('administrator_fakeorder')->with('success', 'Fake orders imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import orders: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'mobile' => 'required|numeric|digits_between:10,15',
            'package_id' => 'required|exists:packages,id',
            'hotel_id' => 'required|exists:hotels,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password123'),
                'mobile' => $request->mobile
            ]);

            $orderId = DB::table('tbl_orders')->insertGetId([
                'order_code' => 'ORD-' . rand(1000, 9999),
                'user_id' => $user->id,
                'amount' => rand(100, 1000),
                'trans_id' => 'TXN-' . rand(10000, 99999),
                'type' => 'package',
                'user_name' => $request->name,
                'user_email' => $request->email,
                'user_phone' => $request->mobile,
                'created_at' => now()
            ]);

            $hotelData = DB::table('hotels')->where('id', $request->hotel_id)->select('id', 'name')->first() ?: 
                (object)['id' => 0, 'name' => 'Fake Hotel'];
            $packageData = DB::table('packages')->where('id', $request->package_id)->select('id', 'title')->first() ?: 
                (object)['id' => 0, 'title' => 'Fake Package'];

            DB::table('order_details')->insert([
                'order_id' => $orderId,
                'hotel_id' => $request->hotel_id,
                'coupon' => 'FAKE-' . $orderId,
                'hotel_data' => json_encode($hotelData),
                'valid_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'status' => ['Pending', 'Redeem'][rand(0, 1)],
                'type' => 'Package',
                'package_id' => $request->package_id,
                'coupon_data' => json_encode(['title' => $packageData->title])
            ]);

            DB::table('packages')->where('id', $request->package_id)->decrement('limit')->increment('sold_count');
            DB::commit();
            return redirect()->route('administrator_fakeorder')->with('success', 'Fake order created.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create order.')->withInput();
        }
    }

    public function orderList(Request $request)
    {
        $query = DB::table('tbl_orders')
            ->leftJoin('users', 'tbl_orders.user_id', '=', 'users.id')
            ->leftJoin('order_details', 'tbl_orders.id', '=', 'order_details.order_id')
            ->leftJoin('packages', 'order_details.package_id', '=', 'packages.id')
            ->leftJoin('hotels', 'order_details.hotel_id', '=', 'hotels.id')
            ->select(
                'tbl_orders.id',
                'tbl_orders.order_code',
                'users.name as user_name',
                'packages.title as package_title',
                'hotels.name as hotel_name'
            );

        if ($request->has('title') && $request->title != '') {
            $search = $request->title;
            $query->where('tbl_orders.order_code', 'like', "%{$search}%")
                  ->orWhere('users.name', 'like', "%{$search}%");
        }

        $orders = $query->orderBy('tbl_orders.created_at', 'desc')->paginate(10);

        $html = '';
        foreach ($orders as $order) {
            $html .= '<tr>';
            $html .= '<td>' . ($order->order_code ?? 'N/A') . '</td>';
            $html .= '<td>' . ($order->user_name ?? 'N/A') . '</td>';
            $html .= '<td>' . ($order->package_title ?? 'N/A') . '</td>';
            $html .= '<td>' . ($order->hotel_name ?? 'N/A') . '</td>';
            $html .= '<td><button class="btn btn-sm btn-info" onclick="viewRecord(' . $order->id . ')">View</button></td>';
            $html .= '</tr>';
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'pagination' => $orders->links()->toHtml()
        ]);
    }

    public function orderDetails($id)
    {
        $order = DB::table('tbl_orders')
            ->leftJoin('users', 'tbl_orders.user_id', '=', 'users.id')
            ->leftJoin('order_details', 'tbl_orders.id', '=', 'order_details.order_id')
            ->leftJoin('packages', 'order_details.package_id', '=', 'packages.id')
            ->leftJoin('hotels', 'order_details.hotel_id', '=', 'hotels.id')
            ->select(
                'tbl_orders.id',
                'tbl_orders.order_code',
                'users.name as user_name',
                'users.email as user_email',
                'tbl_orders.user_phone',
                'packages.title as package_title',
                'hotels.name as hotel_name',
                'order_details.valid_date',
                'order_details.status',
                'order_details.coupon'
            )
            ->where('tbl_orders.id', $id)
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found.']);
        }

        $html = '<div class="card">';
        $html .= '<div class="card-header"><h3 class="card-title">Order: ' . ($order->order_code ?? 'N/A') . '</h3></div>';
        $html .= '<div class="card-body">';
        $html .= '<p><strong>User:</strong> ' . ($order->user_name ?? 'N/A') . '</p>';
        $html .= '<p><strong>Email:</strong> ' . ($order->user_email ?? 'N/A') . '</p>';
        $html .= '<p><strong>Phone:</strong> ' . ($order->user_phone ?? 'N/A') . '</p>';
        $html .= '<p><strong>Package:</strong> ' . ($order->package_title ?? 'N/A') . '</p>';
        $html .= '<p><strong>Hotel:</strong> ' . ($order->hotel_name ?? 'N/A') . '</p>';
        $html .= '<p><strong>Coupon Code:</strong> ' . ($order->coupon ?? 'N/A') . '</p>';
        $html .= '<p><strong>Valid Date:</strong> ' . ($order->valid_date ? date('d/m/Y', strtotime($order->valid_date)) : 'N/A') . '</p>';
        $html .= '<p><strong>Status:</strong> <span class="badge ' . ($order->status == 'Pending' ? 'bg-info' : 'bg-success') . '">' . ($order->status ?? 'N/A') . '</span></p>';
        $html .= '</div></div>';

        return response()->json(['success' => true, 'html' => $html]);
    }
}