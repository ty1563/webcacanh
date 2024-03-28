<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSanPhamRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_san_pham'                  =>  "required|unique:san_phams,ten_san_pham,except,id",
            'hinh_anh'                      =>  "required",
            'mo_ta'                         =>  "required",
            'size_active'                   =>  "required|boolean",
            'id_danh_muc'                   =>  "required|exists:danh_mucs,id",
            'id_thuong_hieu'                =>  "required|exists:thuong_hieus,id",
        ];
    }
    public function messages()
    {
        return [
            'required'         => ':attribute bắt buộc phải có',
            'unique'           => ':attribute đã tồn tại',
            'boolean'          => ":attribute phải là true hoặc false",
            'exists'           => ':attribute không tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'ten_san_pham'     => 'Tên sản phẩm',
            'hinh_anh'         => 'Hình ảnh',
            'mo_ta'            => 'Mô tả',
            'size_active'      => 'Kích hoạt biến thể',
            'id_danh_muc'      => 'Danh mục',
            'id_thuong_hieu'   => 'Thương hiệu',
        ];
    }
}
