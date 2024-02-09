<?php

namespace App\Http\Requests\Admin\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [

            'title'         =>['required','string'],
            'category_id'   =>['required','integer',"exists:categories,id"],
            'status'        =>['required'],

        ];
        if ($this->method() == 'PUT'){

            $rules['title']        =['string'];
            $rules['category_id']  = ['integer',"exists:categories,id"];
            $rules['status']       =['required'];

        }
        return $rules;

    }
}