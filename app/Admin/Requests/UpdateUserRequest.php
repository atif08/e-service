<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'role_id' => ['required'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
        ];
    }
}
