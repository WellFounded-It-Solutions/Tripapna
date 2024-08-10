<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (Auth::check()) {
            if (! $request->user()->hasRole($role)) {
                abort(404);
            }
            if ($permission !== null && ! $request->user()->can($permission)) {
                abort(404);
            }
          

            return $next($request);
        } else {
            if ($role == 'admin') {
                return Redirect::to('administrator');
            } elseif ($role == 'subadmin') {
                return Redirect::to('subadmin');
            } elseif ($role == 'manager') {
                return Redirect::to('manager');
            } elseif ($role == 'agent') {
                return Redirect::to('agent');
            }
        }
        // Check if the user is authenticated
        // if (Auth::check()) {
        //     // Check if the user has the specified role
        //     if (!$request->user()->hasRole($role)) {
        //         abort(404); // Unauthorized access
        //     }
        //     // Check if the user has the specified permission (if provided)
        //     if ($permission !== null && !$request->user()->can($permission)) {
        //         abort(404); // Unauthorized access
        //     }
    
        //     return $next($request);
        // }
    
        // // If the user is not authenticated, determine the redirection path based on role
        // switch ($role) {
        //     case 'admin':
        //         return Redirect::to('administrator');
        //     case 'subadmin':
        //         return Redirect::to('subadmin');
        //     case 'manager':
        //         return Redirect::to('manager');
        //     case 'agent':
        //         return Redirect::to('agent');
        //     case 'customer':
        //         return Redirect::to('customer/login'); // Redirect to customer login
        //     default:
        //         return redirect('/'); // Redirect to home or any other default page
        // }
    }
}
