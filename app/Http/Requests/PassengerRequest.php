<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PassengerRequest extends FormRequest
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
        $requestRule = [
            'name' => ['required'],
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'travel_time' => ['required','regex:(^[0-2][0-9]|[3][0-1]\/([0-1][0-9])\/([0-2]+[0-9]{3})\/([0-1][0-9]|[2][0-4])\/([0-6][0-9])$)'],
            'travel_time' => 'after:now'
        ];
        if($this->passenger == null){
            $requestRule['avatar'] = 'required|'.$requestRule['avatar'];
        }
        return $requestRule;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên đã tồn tại',
            'avatar.required' => 'Ảnh không được để trống',
            'avatar.image' => 'Không đúng định dạng ảnh',
            'travel_time.required' => 'Thời gian không được để trống',
            'travel_time.regex' => 'Không đúng định dạng ngày giờ',
            'travel_time.after' => 'Chọn thời gian lớn hơn ngày hiện tại'
        ];
    }
}
