<?php

namespace Modules\Core\Libraries\Rules;

use Illuminate\Contracts\Validation\Rule;

class mobileValidation implements Rule
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
        $regex = '/^(\+98|0098|98|0)?9\d{9}$/m';
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
