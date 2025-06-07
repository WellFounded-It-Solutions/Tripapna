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
        $invites = Invite::query();

        if ($request->has('sales_id')) {
            $invites->where('sales_id', $request->sales_id);
        }

        if ($request->has('status')) {
            $invites->where('status', $request->status);
        }

        if ($request->has('cart_id')) {
            $invites->where('cart_id', $request->cart_id);
        }

        return response()->json([
            'success' => true,
            'invites' => $invites->get()
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
