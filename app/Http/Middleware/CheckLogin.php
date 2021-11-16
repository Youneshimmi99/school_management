<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class CheckLogin
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
    //    dd(Auth::guard("admin")->user()->email) ;
        // dd(Auth::guard("admin")->user()->name);
        // dd(Auth::guard("admin")->check());
        // Auth::guard("admin")->check()
    //    return Auth::check();
         if (Auth::guard("admin")->check()){
             return $next($request);
        }
        else 
        return redirect('/login/admin');     
        
       
       
        
    }
}
