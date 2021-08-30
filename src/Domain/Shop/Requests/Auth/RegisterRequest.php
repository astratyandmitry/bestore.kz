<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * @property integer $city_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 */
class RegisterRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', 'max:80'],
            'phone' => ['required', 'regex:/^(\+\d{1})\((\d{3})\)(\d{7})$/i', Rule::unique('users', 'phone')],
            'email' => ['required', 'max:100', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
