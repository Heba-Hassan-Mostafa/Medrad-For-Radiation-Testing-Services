<?php

namespace App\Http\Requests\Website;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'contact_first_name'             =>['required','string'],
            'contact_last_name'              =>['required','string'],
            'email'                          =>['required','email'],
            'contact_phone'                  =>['required','numeric'],
            'contact_message'                =>['required','string'],
             'g-recaptcha-response'          => ['required',function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify",[
                    'secret'   => config('services.recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => \request()->ip
                    
                    ]);
            if (!$g_response->json('success')) {
                $fail("The {$attribute} is invalid.");
            }
        }]
        ];
    }
}