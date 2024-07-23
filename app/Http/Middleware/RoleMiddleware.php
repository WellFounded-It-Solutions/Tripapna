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
    }
}
