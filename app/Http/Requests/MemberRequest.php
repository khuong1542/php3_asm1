<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $requestRole = [
           'name' => ['required', Rule::unique('users')->ignore($this->member)],
           'avatar' => 'image',
           'email' => ['required', Rule::unique('users')->ignore($this->member), 'email'],
        ];
        if($this->member == null){
            $requestRole['avatar'] = 'required|'.$requestRole['avatar'];
            $requestRole['password'] = 'required|min:6';
        }
        return $requestRole;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên đã tồn tại',
            'avatar.required' => 'Ảnh không được để trống',
            'avatar.mines' => 'Chọn đúng định dạng ảnh',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự'
        ];
    }
}
