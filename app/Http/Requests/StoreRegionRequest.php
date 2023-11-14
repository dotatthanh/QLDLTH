<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegionRequest extends FormRequest
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
            'name' => [
                'required', 'max:255',
                Rule::unique('regions')->ignore($this->region),
            ],
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Trung tâm là trường bắt buộc.', 
            'name.required' => 'Tên phân vùng là trường bắt buộc.', 
            'name.max' => 'Tên phân vùng không được dài quá :max ký tự.', 
            'name.unique' => 'phân vùng đã tồn tại.', 
        ];
    }
}
