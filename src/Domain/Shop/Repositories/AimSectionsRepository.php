<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\AimSection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class AimSectionsRepository
{
    /**]
     * @param string $hru
     * @return \Domain\Shop\Models\AimSection
     */
    public function findByHru(string $hru): AimSection
    {
        return AimSection::query()->where('hru', $hru)->with(['aims'])->firstOrFail();
    }
}
