<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username'  => "required|unique:admins,username,except,id",
            'email'     => "nullable|unique:admins,email,except,id",
            'password'  => "required|min:6"
        ];
    }
}
