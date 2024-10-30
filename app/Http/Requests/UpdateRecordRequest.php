<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordRequest extends FormRequest {

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

        $recordId = $this->route('record')->id;

        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                "unique:records,name,$recordId"
            ]
        ];

        return $rules;

    }

}
