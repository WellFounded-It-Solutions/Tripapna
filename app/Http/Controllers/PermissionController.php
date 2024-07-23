<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function store(Request $request)
        {
            if ($request->user()->can('create-tasks')) {
                echo 'create-tasks';
            }
            $user = $request->user(); //getting the current logged in user
            //dd($user->hasRole('user','editor')); // and so on
        }

        public function destroy(Request $request, $id)
        {
            if ($request->user()->can('delete-tasks')) {
                echo 'delete-tasks';
            }
        }
}
