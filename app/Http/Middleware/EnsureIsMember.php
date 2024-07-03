<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureIsMember {

    public function handle(Request $request, Closure $next): Response {
        if (Auth::check()) {
            if (strtolower(Auth::user()->role) == config('constants.user.role.member')) {
                return $next($request);
            }
     
            return redirect(route('index'));
        }

        return redirect(route('login'));
    }
}