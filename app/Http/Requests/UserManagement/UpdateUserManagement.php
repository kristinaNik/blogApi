<?php

namespace App\Http\Requests\UserManagement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserManagement extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'sometimes',
            'email' => 'sometimes|email|unique:users',
            'password' => 'sometimes|nullable',
            'role' => 'exists:roles,id',
            'permissions' => 'exists:permissions,id'
        ];
    }
}
