<?php
/**
 * Created by PhpStorm.
 * User: HieuLuongCong
 * Date: 31-03-02016
 * Time: 2:42 PM
 */
namespace App\Http\Middleware;

use Closure;

class SuperAdminMiddleware
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
        if (!$request->user()->isSuper()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin.index');
            }
        }
        return $next($request);
    }
}
