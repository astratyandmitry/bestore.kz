<?php

namespace Domain\Shop\Requests\Account;

use Domain\Shop\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * @property string $current_password
 * @property string $email
 */
class PersonalSettingsRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|current_password',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth('shop')->id())],
        ];
    }
}
