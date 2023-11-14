<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConferenceRequest extends FormRequest
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
            'title' => 'required|max:255', 
            'date' => 'required|date',
            'unit' => 'required|max:255',
            'bridge_point' => 'required|numeric|min:1',
            'preside' => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Ngày là trường bắt buộc.',
            'date.date' => 'Ngày không đúng định dạng.',
            'unit.required' => 'Đơn vị là trường bắt buộc.',
            'title.required' => 'Hội nghị là trường bắt buộc.', 
            'title.max' => 'Hội nghị không được dài quá :max ký tự.', 
            'unit.max' => 'Đơn vị không được dài quá :max ký tự.', 
            'title.unique' => 'Hội nghị đã tồn tại.', 
            'bridge_point.required' => 'Số điểm cầu là trường bắt buộc.', 
            'bridge_point.min' => 'Số điểm cầu ít nhất là :min.', 
            'bridge_point.numeric' => 'Số điểm phải là định dạng số.', 
            'preside.required' => 'Chủ trì là trường bắt buộc.', 
            'preside.max' => 'Chủ trì không được dài quá :max ký tự.', 
        ];
    }
}
