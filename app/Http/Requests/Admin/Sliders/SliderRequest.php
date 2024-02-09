<?php

namespace App\Http\Requests\Admin\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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

            'title'         =>['sometimes','nullable'],
            'status'        =>['required'],
           // 'link'          =>['sometimes','nullable','url'],
           // 'description'   =>['sometimes','nullable'],
            'image'         =>['required','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],

        ];
        if ($this->method() == 'PUT'){

            $rules['title']       =['sometimes','nullable','string'];
            //$rules['link']        =['sometimes','nullable','url'];
            $rules['status']      =['required'];
            $rules['image']       =['image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'];
            //$rules['description'] =['sometimes','nullable'];

        }
        return $rules;
    }
}