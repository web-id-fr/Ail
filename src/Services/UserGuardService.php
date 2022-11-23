<?php

namespace Webid\Ail\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Webid\Ail\Exceptions\GuardUnauthorized;
use Webid\Ail\Exceptions\ProviderDriverException;
use Webid\Ail\Exceptions\ProviderModelException;

class UserGuardService
{
    /**
     * @throws Exception
     */
    public function getUsersForGuard(string $guard): LengthAwarePaginator
    {
        $model = $this->getModelForGuard($guard);
        /** @var int $perPage */
        $perPage = config('ail.perPage', 15);

        return $model::query()
            ->paginate($perPage);
    }

    /**
     * @throws Exception
     */
    public function getModelForGuard(string $guard): Model
    {
        /** @var array $guards */
        $guards = config('ail.guards');

        if (! in_array($guard, $guards)) {
            throw new GuardUnauthorized();
        }

        /** @var string|null $driver */
        $driver = config('auth.providers.'.$guard.'.driver');

        if ($driver !== 'eloquent') {
            throw new ProviderDriverException();
        }

        /** @var string|null $model */
        $model = config('auth.providers.'.$guard.'.model');

        if (! $model || ! class_exists($model)) {
            throw new ProviderModelException();
        }

        /** @var Model $instance */
        $instance = new $model;

        return $instance;
    }
}
