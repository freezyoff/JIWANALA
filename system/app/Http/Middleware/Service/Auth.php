<?php

namespace App\Http\Middleware\Service;

use Closure;
use Illuminate\Support\Facades\Auth as LaravelAuth;

class Auth
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
        if (!LaravelAuth::check()) {
            return redirect()->route('service.auth.login');
        }
		
		if (\Auth::user()->activated != 1){
			return abort(403,trans('http_error.403'));
		}

        return $next($request);
    }
}
