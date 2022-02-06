<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'repassword' => 'required',
            'confpassword' => 'required|same:repassword'
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Nhập mật khẩu cũ',
            'repassword.required' => 'Nhập mật khẩu mới',
            'confpassword.required' => 'Nhập lại mật khẩu mới',
            'confpassword.same' => 'Nhập lại mật khẩu không chính xác',
        ];
    }
}
