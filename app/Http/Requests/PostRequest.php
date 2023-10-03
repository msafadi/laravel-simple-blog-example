<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'string',
            'featured_image' => 'image|dimensions:min_width=300,min_height=300'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute مطلوب.',
            'title.required' => 'عنوان المقال مطلوب',
        ];
    }
}
