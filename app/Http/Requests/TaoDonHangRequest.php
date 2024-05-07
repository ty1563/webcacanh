<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaoDonHangRequest extends FormRequest
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
            'diaChi.ten'   => "required|string",
            'diaChi.email' => "required",
            "diaChi.phone" => "required|numeric|min:10",
            "diaChi.dia_chi_cu_the" => "required",
            "diaChi.city" => "required",
            "diaChi.huyen" => "required",
            "diaChi.xa" => "required",
        ];
    }
    public function messages()
    {
        return [
            'required'  => ":attribute bắt buộc phải có",
            'string'    => ":attribute bắt buộc là kiểu string",
            'numeric'   => ":attribute bắt buộc là kiểu số",
            'min'       => ":attribute quá ngắn",
        ];
    }
    public function attributes()
    {
        return [
            'diaChi.ten'       => "Họ tên",
            'diaChi.email'     => "Địa chỉ email",
            "diaChi.phone"     => "Số điện thoại",
            "diaChi.dia_chi_cu_the"    => "Địa chỉ cụ thể",
            "diaChi.city"    => "Tỉnh thành",
            "diaChi.huyen"    => "Huyện",
            "diaChi.xa"    => "Xã",
        ];
    }
}
