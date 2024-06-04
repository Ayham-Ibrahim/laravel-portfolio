<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
            'name' => ['nullable','string'],
            'phone_number' => ['nullable','string'],
            'birth_date' => ['nullable','string','date'],
            'country' => ['nullable','string'],
            'city' => ['nullable','string'],
            'address' => ['nullable','string'],
            'website' => ['nullable','string'],
            'email' => ['nullable','string'],
            'job_title' => ['nullable','string'],
            'first_image' => ['nullable','image','mimes:jpeg,png,jpg,gif'],
            'second_image' => ['nullable','image','mimes:jpeg,png,jpg,gif'],
            'cv' => ['nullable','mimes:pdf,doc,docx','max:2048'],
        ];  
    }
}
