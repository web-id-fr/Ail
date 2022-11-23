<?php

namespace Webid\Ail\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lab404\Impersonate\Services\ImpersonateManager;

class IsImpersonating
{
    public function __construct(private readonly ImpersonateManager $impersonateManager)
    {
    }

    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        if (! $this->impersonateManager->isImpersonating()) {
            abort(403);
        }

        return $next($request);
    }
}
