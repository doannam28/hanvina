<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'messages' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg|max:2048',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'messages.required' => 'Tin nhắn không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'image.max' => 'Ảnh không được vượt quá 2MB',
            'image.mimes' => 'Ảnh không đúng định dạng',
        ];
    }
}
