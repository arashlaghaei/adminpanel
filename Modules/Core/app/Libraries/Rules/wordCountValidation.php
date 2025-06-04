<?php

namespace Modules\Core\Libraries\Rules;

use Illuminate\Contracts\Validation\Rule;

class wordCountValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $wordCount;

    /**
     * @param $wordCount
     */

    public function __construct($wordCount)
    {
        $this->wordCount = $wordCount;
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
        $words = explode(' ', $value);
        $nbWords = count($words);
        return ($nbWords >= 0 && $nbWords <= $this->wordCount);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "تعداد کلمه بیش از $this->wordCount عدد میباشد";
    }
}
