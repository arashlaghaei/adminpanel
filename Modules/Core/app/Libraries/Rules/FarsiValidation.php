<?php

namespace Modules\Core\Libraries\Rules;

use Illuminate\Contracts\Validation\Rule;

class FarsiValidation implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        $rules = [
//            "A", "B", "C", "D", "E", "F", "G", "H", 'I', "J", "K", 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
//            "a", "b", "c", "d", "e", "f", "g", "h", 'i', "j", "k", 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
//            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹",
//            '$', '-', '_', '.', '+', '!', '*', '(', ')', '{', '}', '|', '\\', '/', "'", '^', '~', '[', ']', '`', '<', '>', '#', '%', '"', ';', '?', ':', '@', '&', '=', '.'
//        ];
//        $string = str_replace($rules, '', $value);
//        $string = filter_var($string, FILTER_SANITIZE_STRING);
//        $string = preg_replace('/&#?[a-z0-9]+;/i', ' ', $string);
//        $string = trim(preg_replace('/\s\s+/', ' ', $string));
//        $string = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
//

        $rules = [
            "ا", "ب", "پ‍", "ت", "ث", "ج",
            "چ", "ح", 'خ', "د", "ذ", 'ر',
            'ز', 'ژ', 'س', 'ش', 'ص', 'ض',
            'ط', 'ظ', 'ع', 'غ', 'ف', 'ق',
            'ک', 'گ', 'ل', "م", "ن", "و",
            "ه", "ی","پ",
            'ة','هٔ','اً','آ','ء','ي', ' ',',','-',
            '۱','۲','۳','۴','۵','۶', '۷','۸','۹', '۱۰',
            '1','2','3','4','5','6', '7','8','9', '10',

        ];
        $string = str_replace($rules, '', $value);

        return mb_strlen($string) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'لطفا حروف فارسی وارد کنید';
    }
}
