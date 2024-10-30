<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {

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
            'name' => ['required', 'string', 'min:8', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:Users'],
            'password' => ['required', 'string', 'min:8', 'max:32']
        ];

        return $rules;

    }

}
