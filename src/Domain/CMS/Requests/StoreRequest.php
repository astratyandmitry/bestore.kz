<?php

namespace Domain\CMS\Requests;

class StoreRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder->addRules([
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|max:500',
            'address_details' => 'nullable|max:500',
            'phone' => 'required|max:30',
            'working_hours' => 'required',
            'map_embed' => 'required',
            'active' => 'boolean',
        ]);
    }
}
