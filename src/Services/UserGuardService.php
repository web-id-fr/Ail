<?php

namespace Webid\Ail\Services;

use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
    public function getUsersForGuardAndSearch(string $guard, string $search = null): LengthAwarePaginator
    {
        $model = $this->getModelForGuard($guard);
        /** @var int $perPage */
        $perPage = config('ail.perPage', 15);

        return $model::query()
            ->when($search, fn (Builder $query) => $query->where(
                /** @phpstan-ignore-next-line  */
                $model->getImpersonateAttributeToSearch(),
                'LIKE',
                "%$search%"
            ))
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

        /** @var string|null $provider */
        $provider = $this->getProviderForGuard($guard);

        /** @var string|null $driver */
        $driver = config('auth.providers.'.$provider.'.driver');

        if ($driver !== 'eloquent') {
            throw new ProviderDriverException();
        }

        /** @var string|null $model */
        $model = config('auth.providers.'.$provider.'.model');

        if (! $model || ! class_exists($model)) {
            throw new ProviderModelException();
        }

        /** @var Model $instance */
        $instance = new $model;

        return $instance;
    }

    private function getProviderForGuard(string $guard): ?string
    {
        /** @var string|null $provider */
        $provider = config("auth.guards.$guard.provider");

        return $provider;
    }
}
