<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Slide;
use Illuminate\Database\Eloquent\Collection;

class SlidesRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Slide::query()->get();
    }
}
