<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Ambassador;

class AmbassadorRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('instagram_username', Ambassador::getTableName())
            ->addMetaRules()
            ->addRules([
                'name' => 'required|max:100',
                'instagram_username' => 'required|max:80',
                'photo' => 'required',
                'active' => 'boolean',
            ]);
    }
}
