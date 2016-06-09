<?php

namespace App\Http\Middleware;

use Closure;

class ManagerMiddleware
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
        if ($request->user()->hasRole('admin') || $request->user()->hasRole('user') || $request->user()->isSuper()) {
            return $next($request);
        }else{
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('home.index');
            }
        }
    }
}
