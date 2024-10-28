<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest {

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

        $taskId = $this->route('task')->id;

        $rules = [
            'name' => [
                'string',
                'min:3',
                'max:255',
                "unique:tasks,name,$taskId"
            ],
            'description' => [
                'string'
            ],
            'due_date' => [
                'date',
                'after_or_equal:-15 days'
            ],
            'status_id' => [
                'integer',
                'exists:statuses,id'
            ]
        ];

		foreach($rules as &$attribute)
			$attribute[] = $this->method() === 'PATCH' ? 'sometimes' : 'required'
		;

        return $rules;

    }

}
