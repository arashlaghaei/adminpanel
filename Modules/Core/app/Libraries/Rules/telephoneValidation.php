<?php

namespace Modules\Core\Libraries\Rules;

use Illuminate\Contracts\Validation\Rule;

class telephoneValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $regex = '/^0\d{2,3}\d{8}$/m';
        preg_match_all($regex, $value, $matches, PREG_SET_ORDER, 0);
        return count($matches);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره صحیح نمیباشد';
    }
}
