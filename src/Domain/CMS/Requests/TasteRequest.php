<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Taste;

class TasteRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Taste::getTableName())
            ->addRules([
                'hru' => 'required|max:40|alpha_dash',
                'name' => 'required|max:80',
            ]);
    }
}
