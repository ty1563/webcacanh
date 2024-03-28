<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThuongHieuRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_thuong_hieu'            =>   "required|unique:thuong_hieus,ten_thuong_hieu,except,id",
            'thong_tin_thuong_hieu'      =>   "required",
        ];
    }
    public function messages()
    {
        return [
            'required'                   => ':attribute bắt buộc phải có',
            'unique'                     => ':attribute đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'ten_thuong_hieu'            => 'Tên thương hiệu',
            'thong_tin_thuong_hieu'      => 'Thông tin thương hiệu',
        ];
    }
}
