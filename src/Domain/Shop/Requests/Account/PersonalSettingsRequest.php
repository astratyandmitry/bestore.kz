<?php

namespace Domain\Shop\Requests\Account;

use Domain\Shop\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * @property string $current_password
 * @property integer $city_id
 * @property string $email
 * @property string $name
 * @property string $phone
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
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', 'max:80'],
            'phone' => ['required', 'regex:/^(\+\d{1})\((\d{3})\)(\d{7})$/i', Rule::unique('users', 'phone')->ignore(auth('shop')->id())],
            'email' => ['required', 'max:100', 'email', Rule::unique('users', 'email')->ignore(auth('shop')->id())],
        ];
    }
}
