<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\AimSection;

class AimSectionRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', AimSection::getTableName())
            ->addMetaRules()
            ->addRules([
                'hru' => 'required|max:80|alpha_dash',
                'name' => 'required|max:120',
                'title' => 'required|max:200',
                'active' => 'boolean',
            ]);
    }
}
