<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bail',
            'newPassword'     => 'required|min:8|different:email|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', //1 thuong 1 hoa 1 so
            'newPassword1'    => 'same:newPassword', //1 thuong 1 hoa 1 so
        ];
    }

}
