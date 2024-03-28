<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChuyenMucRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_chuyen_muc'    => 'required|max:200',
            'gioi_thieu'        => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'required' => ":attribute bắt buộc phải có",
            'max'     => ':attribute quá dài',
        ];
    }
    public function attributes()
    {
        return [
            'ten_chuyen_muc' => "Tên chuyên mục",
            'gioi_thieu'     => "Giới thiệu",
        ];
    }
}
