<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        return [

            'first_name'      =>['required'],
            'last_name'       =>['required'],
            'email'           =>['required','email'],
            'phone'           =>['required','numeric'],
            'image'           =>['nullable','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],

        ];
    }

}