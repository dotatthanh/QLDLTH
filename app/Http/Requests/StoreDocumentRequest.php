<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            // 'name' => 'required|max:255', 
            'file' => 'required|mimes:pdf,doc,docx',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Tên tài liệu là trường bắt buộc.', 
            // 'name.max' => 'Tên tài liệu không được dài quá :max ký tự.', 
            'file.required' => 'Tập tin tài liệu là trường bắt buộc.',
            'file.mimes' => 'Tập tin tài liệu không đúng định dạng (pdf, doc, docx).',
        ];
    }
}
