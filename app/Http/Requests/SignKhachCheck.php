<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignKhachCheck extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bail',
            'username' => 'required|min:8|max:20|unique:khach_hangs,username,except,id',
            'password' => 'required|min:8|different:email|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', //1 thuong 1 hoa 1 so
            'email' => 'required|email|unique:khach_hangs,email,except,id',
        ];
    }
}
