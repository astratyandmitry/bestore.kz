<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Aim;

class AimRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('name', Aim::getTableName())
            ->addRules([
                'section_id' => 'required|exists:aim_sections,id',
                'name' => 'required|max:120',
                'about' => 'required',
                'active' => 'boolean',
            ]);

        for ($i = 1; $i <= 4; $i++) {
            $this->rulesBuilder->addRules([
                "product_id_{$i}" => 'nullable',
            ]);

            $this->rulesBuilder->addRulesWhen($this->get("product_id_{$i}") !== null, [
                "product_id_{$i}" => 'required|exists:catalog,id',
            ]);
        }
    }
}
