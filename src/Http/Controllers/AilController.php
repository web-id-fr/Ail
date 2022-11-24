<?php

namespace Webid\Ail\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Lab404\Impersonate\Services\ImpersonateManager;
use Webid\Ail\Http\Middleware\VerifyEnv;
use Webid\Ail\Http\Middleware\VerifyGuard;
use Webid\Ail\Services\UserGuardService;

class AilController extends Controller
{
    public function __construct(
        private readonly UserGuardService $userGuardService,
        private readonly ImpersonateManager $impersonateManager
    ) {
        $this->middleware(VerifyGuard::class);
        $this->middleware(VerifyEnv::class);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request, string $guard = null): View
    {
        /** @var array $guards */
        $guards = config('ail.guards');
        /** @var string $defaultGuard */
        $defaultGuard = $guards[0];

        $guard = $guard ?: $defaultGuard;
        /** @var string|null $search */
        $search = $request->input('search');

        $actualUser = auth()->user();
        $users = $this->userGuardService->getUsersForGuardAndSearch($guard, $search);

        return view('ail::index', [
            'isImpersonating' => $this->impersonateManager->isImpersonating(),
            'impersonateId' => $this->impersonateManager->getImpersonatorId(),
            'users' => $users,
            'guards' => $guards,
            'actualGuard' => $guard,
            'actualUser' => $actualUser,
            'search' => $search
        ]);
    }
}
