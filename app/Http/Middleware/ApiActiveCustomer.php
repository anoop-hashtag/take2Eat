<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiActiveCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return response()->json([
            'is_active' => Auth::user()->is_active,
            'from' => 'middleware',
        ], 200);

        if (Auth::user()->is_active == 1) {
            return $next($request);
        }
        $errors = [];
        $errors[] = ['code' => 'auth-001', 'message' => 'Unauthenticated.'];
        return response()->json([
            'errors' => $errors
        ], 401);
    }
}
