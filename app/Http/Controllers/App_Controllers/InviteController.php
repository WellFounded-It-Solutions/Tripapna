<?php

namespace App\Http\Controllers\App_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invite;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
    public function index(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'cart_id'  => 'required|integer',
            'status'   => 'required|string|max:400',
            'sales_id' => 'required|integer',
            'order_id' => 'nullable|integer',
            'card_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // Create new Invite
        $invite = Invite::create([
            'cart_id'  => $request->cart_id,
            'status'   => $request->status,
            'sales_id' => $request->sales_id,
            'order_id' => $request->order_id,
            'card_Id' => $request->card_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agent invited successfully',
            'invite'  => $invite
        ]);
    }

    // Fetch Invites
  public function list(Request $request)
{
    if (!$request->has('sales_id')) {
        return response()->json([
            'success' => false,
            'message' => 'sales_id is reuired'
        ], 422);
    }

    $salesId = $request->sales_id;

    $invites = Invite::select(
            'invite_link.id as invite_id',
            'invite_link.status as invite_status',
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
        ->join('customers', 'carts.customer_id', '=', 'customers.id')
        ->where('invite_link.sales_id', $salesId)
        ->get();

    return response()->json([
        'success' => true,
        'invites' => $invites
    ]);
}


    // Update Invite Status
    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:400',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $invite = Invite::find($request->id);

        if (!$invite) {
            return response()->json([
                'success' => false,
                'message' => 'Invite not found'
            ], 404);
        }

        $invite->status = $request->status;
        $invite->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'invite'  => $invite
        ]);
    }
}
