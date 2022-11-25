<?php

namespace Webid\Ail\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lab404\Impersonate\Services\ImpersonateManager;

class CanImpersonate
{
    public function __construct(private readonly ImpersonateManager $impersonateManager)
    {
    }

    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        if ($this->impersonateManager->isImpersonating()) {
            return $next($request);
        }

        /** @var Authenticatable|null $user */
        $user = auth()->user();

        /** @phpstan-ignore-next-line  */
        if (!$user || !$user->canImpersonate()) {
            abort(403);
        }

        return $next($request);
    }
}
