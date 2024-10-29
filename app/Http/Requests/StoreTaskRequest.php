<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {

        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:tasks'],
            'description' => ['sometimes', 'string'],
            'due_date' => ['required', 'date_format:Y-m-d H:i:s', 'after_or_equal:-15 days'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'user_ids' => ['sometimes', 'array'],
            'user_ids.*' => ['required', 'integer', 'distinct', 'exists:users,id']
        ];

        return $rules;

    }

}
