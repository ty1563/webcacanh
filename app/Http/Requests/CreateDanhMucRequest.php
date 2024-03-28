<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDanhMucRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_danh_muc'      => 'required|unique:danh_mucs,ten_danh_muc,except,id',
            'xep_hang'          => 'required|numeric|min:1',
        ];
    }
    public function messages()
    {
        return [
            'required'   => ':attribute bắt buộc phải có',
            'unique'    => ':attribute đã tồn tại',
            'numeric'   => ':attribute bắt buộc là số',
        ];
    }
    public function attributes()
    {
        return [
            'ten_danh_muc'  => 'Tên danh mục',
            'xep_hang'      => 'Xếp hạng',
        ];
    }
}
