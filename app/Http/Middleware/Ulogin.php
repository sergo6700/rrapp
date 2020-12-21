<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Web\Auth\UloginRegisterController;

/**
 * Class Ulogin
 * @package App\Http\Middleware
 */
class Ulogin
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
		if (!$request->has('token') && !$request->get('token')) {
			$back = strtok(back()->getTargetUrl(), '?');
			$back .= UloginRegisterController::QUERY_PARAM_FOR_CALL_ERROR_POPUP;
			return redirect()->to($back);
		}

		return $next($request);
    }
}
