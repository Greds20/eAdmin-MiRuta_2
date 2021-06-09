<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('usuario') && ($request->path() !='/')){
            return redirect('/')->withErrors(['errors'=>'Debe iniciar sesión.']);
        }
        if(session()->has('usuario') && ($request->path() == '/')){
            return back();
        }
        return $next($request)->header('Cache-Control','no-cache','no-store','max-age=0','must-revalidate')->header('Pragma','no-cache')->header('Expires','Sat 01 3am 1990 00:00:00 GTM');
    }
}
