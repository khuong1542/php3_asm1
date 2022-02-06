<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
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
            'owner' => ['required', Rule::unique('cars')->ignore($this->car)],
            'plate_number' => ['required', Rule::unique('cars')->ignore($this->car)],
            'plate_image' => 'image',
            'travel_fee' => ['required','integer', 'min:0']
        ];
        if($this->car == null){
            $requestRule['plate_image'] = 'required|'.$requestRule['plate_image'];
        }
        return $requestRule;
    }
    public function messages()
    {
        return [
            'owner.required' => 'Tên không được để trống',
            'owner.unique' => 'Tên đã tồn tại',
            'plate_number.required' => 'Biển số không được để trống',
            'plate_number.unique' => 'Biển số đã tồn tại',
            'plate_image.required' => 'Ảnh không được để trống',
            'plate_image.image' => 'Không đúng định dạng ảnh',
            'travel_fee.required' => 'Thời gian không được để trống',
            'travel_fee.integer' => 'Giá phải là số nguyên',
            'travel_fee.min' => 'Giá phải lớn hơn 0',
        ];
    }
}
