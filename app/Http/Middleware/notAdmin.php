<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class notAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has("user") && $request->session()->get("user")->role->name != "Admin") {
            return redirect()->back();
        }

        return $next($request);
    }
}
