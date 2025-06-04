<?php

namespace Modules\Core\Libraries\Rules;

use Illuminate\Contracts\Validation\Rule;

class slugValidation implements Rule
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
        $rules = [
            "ا", "ب", "پ‍", "ت", "ث", "ج",
            "چ", "ح", 'خ', "د", "ذ", 'ر',
            'ز', 'ژ', 'س', 'ش', 'ص', 'ض',
            'ط', 'ظ', 'ع', 'غ', 'ف', 'ق',
            'ک', 'گ', 'ل', "م", "ن", "و",
            "ه", "ی", "پ",
            'آ', ' ', '-',
            '۰','۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۱۰',

            '0','1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ];
        $string = str_replace($rules, '', $value);
        return mb_strlen($string) == 0;


//        $regex = '/^[\x{0621}-\x{0628}\x{062A}-\x{063A}\x{0641}-\x{0642}\x{0644}-\x{0648}\x{064E}-\x{0651}\x{0655}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06BE}\x{06CC}\{0-9}\{a-z}\s]+$/u';
//        preg_match_all($regex, $value, $matches, PREG_SET_ORDER, 0);
//        return count($matches);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'صحیح نمیباشد';
    }
}
