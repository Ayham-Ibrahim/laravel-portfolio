<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'title' => 'required','string',
            'date' => 'required','date',
            'description' => 'required','string',
            'image' => 'required','string',
            'link' => 'required','string',
            'github-repo' => 'required','string',
            // 'employee_id' => ['required','array'],

        ];
    }
}
