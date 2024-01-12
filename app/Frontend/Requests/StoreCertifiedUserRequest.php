<?php

namespace App\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertifiedUserRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:certified_user_applications|max:255',
            'country_id' => 'required',
            'phone_number' => 'required|string|max:20',
            'university_id' => 'required',
            'graduated_field' => 'required|string|max:255',
        ];
    }
}
