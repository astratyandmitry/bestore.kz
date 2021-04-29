<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Badge;

class BadgeRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Badge::getTableName())
            ->addRules([
                'hru' => 'required|max:40|alpha_dash',
                'name' => 'required|max:80',
            ]);
    }
}
