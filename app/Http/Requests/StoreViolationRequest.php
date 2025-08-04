<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreViolationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'violation_category_id' => 'required|exists:violation_categories,id',
            'violation_type_id' => 'required|exists:violation_types,id',
            'violation_date' => 'required|date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Student is required.',
            'student_id.exists' => 'Selected student does not exist.',
            'violation_category_id.required' => 'Violation category is required.',
            'violation_category_id.exists' => 'Selected violation category does not exist.',
            'violation_type_id.required' => 'Violation type is required.',
            'violation_type_id.exists' => 'Selected violation type does not exist.',
            'violation_date.required' => 'Violation date is required.',
            'violation_date.before_or_equal' => 'Violation date cannot be in the future.',
        ];
    }
}