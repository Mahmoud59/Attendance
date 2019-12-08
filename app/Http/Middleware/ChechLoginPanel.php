<?php

namespace App\Http\Middleware;

use Closure;

class ChechLoginPanel
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

    if(session('login'))
        return $next($request);
    else
      return redirect('admin/login');
    }
}
