<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;
use Illuminate\Validation\Rule;

/**
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
            'email' => ['required', 'max:100', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
