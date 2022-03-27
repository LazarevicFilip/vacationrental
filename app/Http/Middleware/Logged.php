<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Logged
{

    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has("user")){
            return redirect()->back();
        }
        return $next($request);
    }
}
