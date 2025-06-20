<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class FakeController extends Controller
{
    //
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
        $check = $this->check($request, 'view-orders', 'view');
        if ($check) {
            $page_name = 'Fake Orders';

            return view('fakeorders.index', compact('page_name'));
        }
    }

  public function create()
    {
        $page_name = 'Create Fake Order';
        // Fetch users, packages, coupons, and hotels for dropdowns
        $users = DB::table('users')->select('id', 'name')->get();
        $packages = DB::table('packages')->select('id', 'title')->get();
        $coupons = DB::table('coupons')->select('id', 'title')->get();
        $hotels = DB::table('hotels')->select('id', 'name')->get();
        return view('fakeorders.create', compact('page_name', 'users', 'packages', 'coupons', 'hotels'));
    }

    /**
     * Store a newly created fake order.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits_between:10,15',
            'trans_id' => 'required|string|max:200',
            'type' => 'required|in:package,coupon',
            'amount' => 'required|numeric|min:0',
            'package_id' => 'required_if:type,package|exists:packages,id',
            'coupon_id' => 'required_if:type,coupon|exists:coupons,id',
            'hotel_id' => 'required|exists:hotels,id',
            'visit_type' => 'required|integer',
            'valid_date' => 'required|date',
            'status' => 'required|in:Pending,Redeem',
            'category_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // Create order in tbl_orders
            $orderData = [
                'order_code' => orderCode(), // Assumed helper function
                'user_id' => $request->input('user_id'),
                'amount' => $request->input('amount'),
                'trans_id' => $request->input('trans_id'),
                'type' => $request->input('type'),
                'user_name' => $request->input('name'),
                'user_email' => $request->input('email'),
                'user_phone' => $request->input('mobile'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $orderId = DB::table('tbl_orders')->insertGetId($orderData);

            // Prepare order_details data
            $couponId = $request->input('type') == 'package' ? 0 : $request->input('coupon_id');
            $packageId = $request->input('type') == 'package' ? $request->input('package_id') : null;

            // Fetch coupon/hotel data for JSON
            $couponData = $request->input('type') == 'coupon' ? 
                DB::table('coupons')->where('id', $couponId)->select('id', 'title', 'custom_coupon_id', 'category_id', 'visit_type')->first() : 
                (object)['id' => 0, 'title' => 'Fake Package Coupon', 'custom_coupon_id' => 'FAKE-' . $orderId, 'category_id' => $request->input('category_id'), 'visit_type' => $request->input('visit_type')];
            $hotelData = DB::table('hotels')->where('id', $request->input('hotel_id'))->select('id', 'name', 'location', 'mobile')->first() ?: 
                (object)['id' => 0, 'name' => 'Fake Hotel', 'location' => 'N/A', 'mobile' => 'N/A'];

            $orderDetailData = [
                'order_id' => $orderId,
                'coupon_id' => $couponId,
                'hotel_id' => $request->input('hotel_id'),
                'coupon' => $couponData->custom_coupon_id ?? 'FAKE-' . $orderId,
                'coupon_data' => json_encode($couponData),
                'hotel_data' => json_encode($hotelData),
                'valid_date' => $request->input('valid_date'),
                'visit_type' => $request->input('visit_type'),
                'mobile_number' => $request->input('mobile'),
                'status' => $request->input('status'),
                'type' => ucfirst($request->input('type')),
                'package_id' => $packageId,
                'category_id' => $request->input('category_id') ?: ($couponData->category_id ?? null),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('order_details')->insert($orderDetailData);

            // Update package limits if package
            if ($request->input('type') == 'package') {
                $package = DB::table('packages')->where('id', $packageId)->first();
                if ($package) {
                    DB::table('packages')->where('id', $packageId)->update([
                        'limit' => $package->limit - 1,
                        'sold_count' => $package->sold_count + 1,
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('administrator_fakeorder')->with('success', 'Fake order created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create fake order: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Fetch order list for AJAX table.
     */
    public function orderList(Request $request)
    {
        $query = DB::table('tbl_orders')
            ->leftJoin('users', 'tbl_orders.user_id', '=', 'users.id')
            ->leftJoin('user_wallets', 'users.id', '=', 'user_wallets.user_id')
            ->select(
                'tbl_orders.id',
                'tbl_orders.order_code', // Assuming order_code is the token (e.g., TRPE001)
                'tbl_orders.user_id',
                'users.name as user_name',
                'tbl_orders.amount',
                'tbl_orders.trans_id',
                'tbl_orders.created_at'
            );

        // Apply search filter
        if ($request->has('title') && $request->title != '') {
            $search = $request->title;
            $query->where(function ($q) use ($search) {
                $q->where('tbl_orders.order_code', 'like', "%{$search}%")
                  ->orWhere('users.name', 'like', "%{$search}%")
                  ->orWhere('tbl_orders.trans_id', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $perPage = 10;
        $orders = $query->orderBy('tbl_orders.created_at', 'desc')->paginate($perPage);

        // Build HTML for table body
        $html = '';
        foreach ($orders as $order) {
            $html .= '<tr>';
            $html .= '<td>' . ($order->order_code ?? 'N/A') . '</td>';
            $html .= '<td>' . ($order->user_name ?? 'N/A') . '</td>';
            $html .= '<td>' . number_format($order->amount ?? 0, 2) . '</td>';
            $html .= '<td>' . ($order->trans_id ?? 'N/A') . '</td>';
            $html .= '<td>' . ($order->created_at ? date('d/m/Y H:i', strtotime($order->created_at)) : 'N/A') . '</td>';
            $html .= '<td><button class="btn btn-sm btn-info" onclick="viewRecord(' . $order->id . ')" data-toggle="tooltip" title="View Details">View</button></td>';
            $html .= '</tr>';
        }

        // Generate pagination links
        $pagination = $orders->links()->toHtml();

        return response()->json([
            'success' => true,
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Fetch order details for modal.
     */
    public function orderDetails($id)
    {
        // Fetch order with user and wallet
        $order = DB::table('tbl_orders')
            ->leftJoin('users', 'tbl_orders.user_id', '=', 'users.id')
            ->leftJoin('user_wallets', 'users.id', '=', 'user_wallets.user_id')
            ->select(
                'tbl_orders.id',
                'tbl_orders.order_code',
                'tbl_orders.user_id',
                'users.name as user_name',
                'users.email as user_email',
                'tbl_orders.amount',
                'tbl_orders.trans_id',
                'tbl_orders.created_at',
                'tbl_orders.type',
                'tbl_orders.user_phone',
                'user_wallets.wallet_amount'
            )
            ->where('tbl_orders.id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.',
            ]);
        }

        // Fetch order details
        $orderDetails = DB::table('order_details')
            ->leftJoin('hotels', 'order_details.hotel_id', '=', 'hotels.id')
            ->select(
                'order_details.coupon',
                'order_details.coupon_data',
                'order_details.hotel_data',
                'order_details.valid_date',
                'order_details.visit_type',
                'order_details.status',
                'order_details.type',
                'order_details.package_id'
            )
            ->where('order_details.order_id', $id)
            ->get();

        // Build HTML for modal
        $html = '<div class="card">';
        $html .= '<div class="card-header"><h3 class="card-title">Order: ' . ($order->order_code ?? 'N/A') . '</h3></div>';
        $html .= '<div class="card-body">';
        $html .= '<p><strong>User:</strong> ' . ($order->user_name ?? 'N/A') . '</p>';
        $html .= '<p><strong>Email:</strong> ' . ($order->user_email ?? 'N/A') . '</p>';
        $html .= '<p><strong>Phone:</strong> ' . ($order->user_phone ?? 'N/A') . '</p>';
        $html .= '<p><strong>Amount:</strong> ' . number_format($order->amount ?? 0, 2) . '</p>';
        $html .= '<p><strong>Transaction ID:</strong> ' . ($order->trans_id ?? 'N/A') . '</p>';
        $html .= '<p><strong>Type:</strong> ' . ($order->type ?? 'N/A') . '</p>';
        $html .= '<p><strong>Wallet Balance:</strong> ' . number_format($order->wallet_amount ?? 0, 2) . '</p>';
        $html .= '<p><strong>Created At:</strong> ' . ($order->created_at ? date('d/m/Y H:i', strtotime($order->created_at)) : 'N/A') . '</p>';

        $html .= '<h4>Order Details</h4>';
        foreach ($orderDetails as $detail) {
            $couponData = json_decode($detail->coupon_data, true);
            $hotelData = json_decode($detail->hotel_data, true);
            $html .= '<div class="card">';
            $html .= '<div class="card-header"><h3 class="card-title">' . ($detail->type == 'Package' ? 'Package' : 'Coupon') . ': ' . ($couponData['title'] ?? 'N/A') . '</h3></div>';
            $html .= '<div class="card-body">';
            $html .= '<p><strong>Coupon Code:</strong> ' . ($detail->coupon ?? 'N/A') . '</p>';
            $html .= '<p><strong>Hotel:</strong> ' . ($hotelData['name'] ?? 'N/A') . ' (' . ($hotelData['location'] ?? 'N/A') . ')</p>';
            $html .= '<p><strong>Valid Date:</strong> ' . ($detail->valid_date ? date('d/m/Y', strtotime($detail->valid_date)) : 'N/A') . '</p>';
            $html .= '<p><strong>Visit Type:</strong> ' . ($detail->visit_type ?? 'N/A') . '</p>';
            $html .= '<p><strong>Status:</strong> <span class="badge ' . ($detail->status == 'Pending' ? 'bg-info' : 'bg-success') . '">' . ($detail->status ?? 'N/A') . '</span></p>';
            $html .= '</div></div>';
        }
        $html .= '</div></div>';

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }
}
