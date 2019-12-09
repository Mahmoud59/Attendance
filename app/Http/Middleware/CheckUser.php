<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        if( Auth::guard('employee-api')->check()){
            return $next($request);
        }
        else{
            return response()->json([
                'status_code' => 401,
                'success' => false,
                'message' => 'Unauthorized',
                'data'  => null
            ]);
        }



    }
}
