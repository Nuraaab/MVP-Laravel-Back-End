<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            "job_title" => "required",
            "description" => "required",
            "location" => "required",
            "user_id" => "required",
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'User ID required',
        ];
    }
}
