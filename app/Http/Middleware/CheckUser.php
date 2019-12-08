<?php

namespace App\Http\Middleware;

use App\Http\Controllers\APIResponseTrait;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    use APIResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::guard('employee-api')->check() || Auth::guard('user-api')->user()){
            return $next($request);
        }
        else{
            return $this->APIResponse(null , "Unauthorized"  ,  401);
        }



    }
}
