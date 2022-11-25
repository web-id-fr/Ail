<?php

namespace Webid\Ail\Services\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SearchInterface
{
    public function __invoke(Builder $query, string $search = null): Builder;
}
