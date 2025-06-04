<?php

namespace Modules\Core\Libraries\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class VideoResolution implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        return 1;
//        $path = $value->store("uploads/temp/" . now()->format('Y-m-d').'/'.$value->input('movieToken'));
//
//        $media = FFMpeg::fromDisk('local')->open($value->getPath());
//
//        $dimensions = $media->getVideoStream()->getDimensions();
//
//        return $dimensions->getWidth() === 1280 && $dimensions->getHeight() === 720;
    }

    public function message()
    {
        return 'The video must be in 720p resolution.';
    }
}
