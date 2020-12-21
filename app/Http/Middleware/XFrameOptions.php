<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class XFrameOptions
 * Middleware that allows us to control the "X-Frame-Options" header
 *
 * @package App\Http\Middleware
 */
class XFrameOptions
{
    /**
     * @var string
     */
    private $IlluminateResponse = 'Illuminate\Http\Response';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Closure                 $next    Anonymous functions
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $xframeOptions = 'SAMEORIGIN';

        if ( !($response instanceof $this->IlluminateResponse)){
            return $response;
        }

        // In this example, we are only allowing the third party to include the "registration.events.index" route (iframe)
        // It's always better to scope this to a given route / set of routes to avoid any unattended security problems
        if (!($request->routeIs('registration.events.register') || $request->routeIs('registration.events.index'))) {
            $response->header('X-Frame-Options', $xframeOptions);
            return $response;
        }

        if ($xframeOptions = env('X_FRAME_OPTIONS', 'SAMEORIGIN')) {
            if (false !== strpos($xframeOptions, 'ALLOW-FROM')) {
                $url = trim(str_replace('ALLOW-FROM', '', $xframeOptions));

                $response->header('Content-Security-Policy', 'frame-ancestors '.$url);
            }
        }

        $response->header('X-Frame-Options', $xframeOptions);
        return $response;
    }
}
