<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'code'      => "required|unique:vouchers,code,except,id",
            'giam_gia'  => "required|numeric",
            'max_uses'  => "required|numeric",
            'status'    => "required|boolean",
            'het_han'   => "required|date|after:today",
        ];
    }
    public function messages()
    {
        $today = Carbon::today()->format('d/m/Y');;
        return [
            'required'  => ":attribute bắt buộc phải có",
            'unique'    => ":attribute đã tồn tại",
            'numeric'   => ":attribute phải là số",
            'boolean'   => ":attribute sai định dạng",
            'date'      => ":attribute bắt buộc là ngày",
            'after'     => ":attribute phải sau ngày {$today}"
        ];
    }
    public function attributes()
    {
        return [
            'code'      => "Mã giảm giá",
            'giam_gia'  => "Giá giảm",
            'max_uses'  => "Giới hạn người dùng",
            'status'    => "trạng thái",
            'het_han'   => "Ngày hết hạn",
        ];
    }
}
