<?php

namespace Webid\Ail\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lab404\Impersonate\Exceptions\InvalidUserProvider;
use Lab404\Impersonate\Exceptions\MissingUserProvider;
use Lab404\Impersonate\Services\ImpersonateManager;

class ImpersonateController extends Controller
{
    public function __construct(private readonly ImpersonateManager $impersonateManager)
    {
    }

    /**
     * @throws InvalidUserProvider
     * @throws MissingUserProvider
     */
    public function take(Request $request, int $id, string $guardName = null): RedirectResponse
    {
        $guardName = $guardName ?? $this->impersonateManager->getDefaultSessionGuard();
        /** @var Authenticatable $user */
        $user = $request->user();

        if (
            $id === $user->getAuthIdentifier()
            && ($this->impersonateManager->getCurrentAuthGuardName() == $guardName)
        ) {
            abort(403);
        }

        if ($this->impersonateManager->isImpersonating()) {
            abort(403);
        }

        /** @phpstan-ignore-next-line  */
        if (! $user->canImpersonate()) {
            abort(403);
        }

        $userToImpersonate = $this->impersonateManager->findUserById($id, $guardName);

        /** @phpstan-ignore-next-line  */
        if ($userToImpersonate->canBeImpersonated()) {
            $this->impersonateManager->take($user, $userToImpersonate, $guardName);
        }

        return redirect()->back();
    }

    public function leave(): RedirectResponse
    {
        if (! $this->impersonateManager->isImpersonating()) {
            abort(403);
        }

        $this->impersonateManager->leave();

        return redirect()->back();
    }
}
