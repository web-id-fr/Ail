<?php

namespace Webid\Ail\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Webid\Ail\Services\Interfaces\SearchInterface;

class SearchUser implements SearchInterface
{
    public function __invoke(Builder $query, string $search = null): Builder
    {
        return $query
            ->when($search, fn (Builder $query) => $query->where(
                'name',
                'LIKE',
                "%$search%"
            )
            );
    }
}
