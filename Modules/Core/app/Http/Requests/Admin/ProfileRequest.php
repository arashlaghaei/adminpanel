<?php

namespace Modules\Core\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {
        $user = $this->user;
        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore($this->user)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'mobile' => [
                'nullable',
                'digits_between:10,15',
                Rule::unique('users', 'mobile')->ignore($this->user),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'nullable|digits_between:10,15',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'nullable|date|before:today',
            'birth_place' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'picture_remove' => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->filled('birth_date')) {
            $this->merge([
                'birth_date' => toGorgian($this->input('birth_date'), 'Y/m/d', true),
            ]);
        }
        $this->merge([
            'picture_remove' => $this->filled('picture_remove') ? 1 : 0,
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
