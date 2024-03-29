<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateKienThucRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'                 => "required",
            'tinh_trang'            => "required|boolean",
            'hinh_anh'              => "nullable|url",
            'mo_ta'                 => "required",
            'noi_dung'              => "required",
            'list_tag'              => "required",
            'list_san_pham'         => "required"
        ];
    }
}
