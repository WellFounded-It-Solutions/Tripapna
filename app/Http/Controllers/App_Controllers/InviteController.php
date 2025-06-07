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
}

