<?php

namespace App\Http\Middleware\Acl;

use Closure;

/**
 * Class HasPermission
 * @package App\Http\Middleware\Acl
 */
class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!$request->user()->hasPermissionTo($permission)) {
            return redirect()->guest(backpack_url('dashboard'));
        }
        return $next($request);
    }
}
