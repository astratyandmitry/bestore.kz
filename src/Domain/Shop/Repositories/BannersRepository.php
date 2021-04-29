<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Banner;
use Illuminate\Database\Eloquent\Collection;

class BannersRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Banner::query()->get();
    }
}
