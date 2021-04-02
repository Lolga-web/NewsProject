<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(User $user)
    {
        return [
            'name' => 'required|string|max:35',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'newPassword' => 'nullable|string|min:3'
        ];
    }

    public function attributes()
    {
        return [
            'newPassword' => 'Новый пароль'
        ];
    }
}
