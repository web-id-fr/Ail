<?php

namespace Webid\Ail\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyEnv
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        /** @var string|null $env */
        $env = config('app.env');

        /** @var array $allowed */
        $allowed = config('ail.allowedEnv');

        if (! in_array($env, $allowed)) {
            abort(401);
        }

        return $next($request);
    }
}
