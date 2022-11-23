<?php

namespace Webid\Ail\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyGuard
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        /** @var string|null $guard */
        $guard = $request->guard;

        if (! $guard) {
            return $next($request);
        }

        /** @var array $guards */
        $guards = config('ail.guards');

        if (! in_array($guard, $guards)) {
            abort(404);
        }

        return $next($request);
    }
}
