<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
            'name' => ['required','string'],
            'phone_number' => ['required','string'],
            'birth_date' => ['required','string','date'],
            'country' => ['required','string'],
            'city' => ['required','string'],
            'address' => ['required','string'],
            'website' => ['required','string'],
            'email' => ['required','string'],
            'job_title' => ['required','string'],
            'first_image' => ['required','image','mimes:jpeg,png,jpg,gif'],
            'second_image' => ['required','image','mimes:jpeg,png,jpg,gif'],
            'cv' => ['required','mimes:pdf,doc,docx','max:2048'],
        ];
    }
}
