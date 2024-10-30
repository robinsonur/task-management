<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest {

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

        $userId = $this->route('user')->id;

        $rules = [
            'name' => ['required', 'string', 'min:8', 'max:255', "unique:Users,name,$userId"],
            'email' => ['required', 'email', 'max:255', 'unique:Users'],
            'password' => ['required', 'string', 'min:8', 'max:32']
        ];

        $methodRule = $this->method() === 'PATCH' ? 'sometimes' : 'required';

		foreach($rules as &$attribute)
			$attribute[] = $methodRule
		;

        return $rules;

    }

    // Validations for deleted records in user_ids array
    // public function withValidator($validator) {

    //     $validator->after(function() use ($validator) {

    //         $userIds = $this->input('user_ids') ?? [];

    //         foreach($userIds as $index => $userId) {

    //             $user = \App\Models\User::onlyTrashed()->find($userId);

    //             if (!$user)
    //                 continue
    //             ;

    //             $field = "user_ids.$index";

    //             $validator->errors()->add(
    //                 $field,
    //                 "The user_ids.$index field has a deleted record."
    //             );

    //         }

    //     });

    // }

}
