<?php

namespace App\Http\Requests\Admin\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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

            'title'         =>['required','string','unique:blogs'],
            'status'        =>['required'],
            'content'       =>['required','string'],
            'publish_date'  =>['required','date'],
            'image'         =>['required','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],
            'keywords'      =>['required','string'],
            'description'   =>['required','string'],

        ];
        if ($this->method() == 'PUT'){

            $rules['title']        =['string'];
            $rules['status']      =['required'];
            $rules['content']     =['string'];
            $rules['publish_date']=['date'];
            $rules['image']       =['image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'];
            $rules['keywords']    =['string'];
            $rules['description'] =['string'];

        }
        return $rules;

    }
}