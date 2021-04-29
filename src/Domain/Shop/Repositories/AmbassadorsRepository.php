<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Ambassador;
use Illuminate\Database\Eloquent\Collection;

class AmbassadorsRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Ambassador::query()->get();
    }
}
