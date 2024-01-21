<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['image'],
            'name' => ['required', 'string'],
            'username' => ['required', 'lowercase', Rule::unique(User::class)->ignore($this->user()->id)],
            'bio' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'current_password' => ['nullable', 'required_with:newPassword', 'current_password'],
            'newPassword' => ['nullable', 'required_with:current_password', 'confirmed', 'different:current_password'],
            'isPrivate' => ['sometimes']
        ];
    }
}
