<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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

            'name'          =>['required','string','unique:team_managments'],
            'position'      =>['required','string'],
            'gender'        =>['required'],
            'image'         =>['sometimes','nullable','image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'],


        ];
        if ($this->method() == 'PUT'){

            $rules['name']        =['string'];
            $rules['position']    = ['string'];
            $rules['gender']      = ['required'];
            $rules['image']       =['image','mimes:png,jpg,jpeg,gif,bmp,webp,svg'];


        }
        return $rules;

    }
}