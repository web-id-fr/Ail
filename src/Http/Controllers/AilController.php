<?php

namespace Webid\Ail\Http\Controllers;

use Exception;
use Illuminate\View\View;
use Webid\Ail\Http\Middleware\VerifyEnv;
use Webid\Ail\Http\Middleware\VerifyGuard;
use Webid\Ail\Services\UserGuardService;

class AilController extends Controller
{
    public function __construct(private readonly UserGuardService $userGuardService)
    {
        $this->middleware(VerifyGuard::class);
        $this->middleware(VerifyEnv::class);
    }

    /**
     * @throws Exception
     */
    public function index(string $guard = null): View
    {
        /** @var array $guards */
        $guards = config('ail.guards');
        /** @var string $defaultGuard */
        $defaultGuard = $guards[0];

        $guard = $guard ?: $defaultGuard;

        $actualUser = auth($guard)->user();
        $users = $this->userGuardService->getUsersForGuard($guard);

        return view('ail::index', [
            'users' => $users,
            'guards' => $guards,
            'actualGuard' => $guard,
            'actualUser' => $actualUser,
        ]);
    }
}
