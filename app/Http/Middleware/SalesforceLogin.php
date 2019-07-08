<?php

namespace App\Http\Middleware;


use Closure;
use Forrest;

class SalesforceLogin
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
        $token = \Session::get('forrest_token');
        // $token = 0;
        if(!$token)
        {
          return redirect('/authenticate');  
        }
        return $next($request);
        
    }
}
