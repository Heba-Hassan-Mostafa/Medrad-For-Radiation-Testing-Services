<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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

            'name'          =>['required','string'],
            'category_id'   =>['required','integer',"exists:categories,id"],
            'status'        =>['required'],
            'content'       =>['required','string'],
            'content_home'  =>['required','string'],
            'publish_date'  =>['required','date'],
            'image'         =>['required','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],
            'keywords'      =>['required','string'],
            'description'   =>['required','string'],

        ];
        if ($this->method() == 'PUT'){

            $rules['name']        =['string'];
            $rules['category_id'] = ['integer',"exists:categories,id"];
            $rules['status']      =['required'];
            $rules['content']     =['string'];
            $rules['content_home']=['string'];
            $rules['publish_date']=['date'];
            $rules['image']       =['image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'];
            $rules['keywords']    =['string'];
            $rules['description'] =['string'];

        }
        return $rules;

    }
}