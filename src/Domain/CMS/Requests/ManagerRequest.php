<?php

namespace Domain\CMS\Requests;

use Domain\CMS\Models\Manager;

class ManagerRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('email', Manager::getTableName())
            ->addRules([
                'email' => 'required|email',
                'role_id' => 'required|exists:manager_roles,id',
            ])
            ->addRulesWhen($this->isMethod('PATCH'), [
                'new_password' => 'sometimes',
            ]);
    }
}
