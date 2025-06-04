<?php

namespace Modules\Core\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class changePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => [
                    'required',
                    Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required' => 'وارد کردن گذرواژه الزامی است.',
            'new_password.confirmed' => 'گذرواژه و تکرار آن مطابقت ندارند.',
            'new_password.min' => 'گذرواژه باید حداقل :min کاراکتر باشد.',
            'new_password.password.letters' => 'گذرواژه باید حداقل شامل یک حرف باشد.',
            'new_password.password.mixed' => 'گذرواژه باید شامل حروف بزرگ و کوچک انگلیسی باشد.',
            'new_password.password.numbers' => 'گذرواژه باید حداقل شامل یک عدد باشد.',
            'new_password.password.symbols' => 'گذرواژه باید حداقل شامل یک کاراکتر ویژه (نماد) باشد.',
            'new_password.password.uncompromised' => 'این گذرواژه در نشت‌های اطلاعاتی قبلی دیده شده و امن نیست. لطفاً گذرواژه دیگری انتخاب کنید.',

            'new_password_confirmation.required' => 'وارد کردن تکرار گذرواژه الزامی است.',
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
