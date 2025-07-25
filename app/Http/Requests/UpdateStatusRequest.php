<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest {

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

        $statusId = $this->route('status')->id;

        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                "unique:statuses,name,$statusId"
            ]
        ];

        return $rules;
    }

}
