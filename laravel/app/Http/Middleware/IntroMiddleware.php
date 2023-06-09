<?php

namespace App\Http\Middleware;

use Closure;

class IntroMiddleware
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
        if (($request->session->get('intro'))) {
            return $next($request);
        }
        return redirect()->route('intro');
    }
}
