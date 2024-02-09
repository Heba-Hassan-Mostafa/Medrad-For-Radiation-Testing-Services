<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'first_name'     =>['required','string','unique:users'],
            'last_name'      =>['required','string'],
            'email'          =>['required','email','unique:users'],
            'password'       =>['required','confirmed'],
            'phone'          =>['required','numeric','unique:users'],
            'image'          =>['nullable','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],

        ];
        if ($this->method() == 'PUT'){

            $rules['first_name']        =['string'];
            $rules['last_name']         =['string'];
            $rules['email']             =['email'];
            $rules['password']          =['string'];
            $rules['phone']             =['numeric'];
            $rules['image']             =['nullable','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'];

        }
        return $rules;
    }
}