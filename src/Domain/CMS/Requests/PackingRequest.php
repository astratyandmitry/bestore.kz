<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Packing;

class PackingRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Packing::getTableName())
            ->addRules([
                'hru' => 'required|max:40|alpha_dash',
                'name' => 'required|max:80',
            ]);
    }
}
