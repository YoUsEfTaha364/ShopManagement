<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $date=session("auth_key");
        $is_verified=now()<$date ? true : false;

         

        
        if(Auth::check() && $is_verified ){
         
              return $next($request);
        }
        else{
             return redirect()->route("admin.check");
        }
    }
}
