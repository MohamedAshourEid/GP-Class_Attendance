<?php

namespace App\Http\Middleware;
session()->start();
use Closure;

class loggedin
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
        if (!session()->has('instructorID')) {

            return redirect('login');
        }
        return $next($request);
    }
}
