<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\City;

class CityRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', City::getTableName())
            ->addRules([
                'hru' => 'required|max:40|alpha_dash',
                'name' => 'required|max:80',
                'phone' => 'required|regex:/^(\+\d{1})\((\d{3})\)(\d{7})$/i',
                'delivery_price' => 'required|integer|min:1',
                'free_delivery_min_price' => 'required|integer|min:1',
                'active' => 'boolean',
            ]);
    }
}
