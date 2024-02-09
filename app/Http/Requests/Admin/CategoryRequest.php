<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

            'name'          =>['required','string','unique:categories'],
            'category_type' =>['required', Rule::in(Category::TYPE)],
            'status'        =>['required'],
        ];
        if ($this->method() == 'PUT'){

            $rules['name']  =['string'];
            $rules['type'] = ['nullable'];
            $rules['status'] =['required'];
        }
        return $rules;

    }
}
