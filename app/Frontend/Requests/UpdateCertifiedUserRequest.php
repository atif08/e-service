<?php

namespace App\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCertifiedUserRequest extends FormRequest
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
    public function rules(): array
    {
        $user = $this->route('certified_user');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'required|string|max:20',
            'status' => 'required'
        ];
    }
}
