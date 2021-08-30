<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Category;

class CityRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Category::getTableName())
            ->addRules([
                'name' => 'required|max:80',
                'phone' => ['required', 'regex:/^(\+\d{1})\((\d{3})\)(\d{7})$/i'],
                'address' => 'required|max:120',
            ]);
    }
}
