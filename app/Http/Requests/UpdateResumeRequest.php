<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeRequest extends FormRequest
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
                'to_date' => 'nullable|date',
                'from_date' => 'nullable|date',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1024',
                'institute' => 'nullable|string|max:255',
        ];
    }
}
