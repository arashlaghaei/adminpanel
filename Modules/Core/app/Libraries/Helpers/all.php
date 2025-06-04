<?php

use App\Models\errorLog;
use App\Models\Setting\setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

function getDefaultPhoto()
{
    return 'files/default.jpg';
}

function toPersian($timestamp, $format = 'Y/m/d', $ago = false)
{
    try {
        if ($ago) {
            return Morilog\Jalali\Jalalian::forge($timestamp)->ago();
        }
        return CalendarUtils::strftime($format, strtotime($timestamp));
    } catch (Throwable $throwable) {
        return null;
    }
}

function toGorgian($timeStamp, $format = 'Y/m/d', $stringOutput = false)
{
    try {
        $timeStamp = persianNumberToEnglish($timeStamp);
        if (strlen($timeStamp) > 12) {
            $format = 'Y/m/d H:i:s';
        }

        $date = CalendarUtils::createDatetimeFromFormat($format, $timeStamp);

        if ($stringOutput) {
            return jdate($date)->toCarbon()->toDateTimeString();
        }
        return $date;

    } catch (Throwable $throwable) {
        return null;
    }
}

function changeFile($path, $line, $text)
{
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $lines[$line] = $text;
    file_put_contents($path, implode("\n", $lines));
}

function clearString($string, $limit = 500)
{
    $string = filter_var(str_limit($string, $limit), FILTER_SANITIZE_STRING);
    $string = preg_replace('/&#?[a-z0-9]+;/i', ' ', $string);
    $string = trim(preg_replace('/\s\s+/', ' ', $string));
    return $string;
}

function slug($string, $isClearString = false)
{
    if ($isClearString) {
        $rules = [
            "ا", "ب", "پ‍", "ت", "ث", "ج",
            "چ", "ح", 'خ', "د", "ذ", 'ر',
            'ز', 'ژ', 'س', 'ش', 'ص', 'ض',
            'ط', 'ظ', 'ع', 'غ', 'ف', 'ق',
            'ک', 'گ', 'ل', "م", "ن", "و",
            "ه", "ی", "پ",
            'آ', ' ', '-',
            '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۱۰',

            '1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u',
            'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',
            'V', 'W', 'X', 'Y', 'Z'
        ];
        $specialCharacters = str_replace($rules, '', $string);
        $string = str_replace($specialCharacters, '', $string);
    }


    $string = str_replace(' ', '-', $string);
    $string = persianNumberToEnglish($string);

    return $string;
}

function sslugold($string)
{
    $string = str_replace(' ', '-', $string);

    // Arabic replace
    $arabic_letters = ['ي', 'ك', 'ؤ', 'ۀ', '٬', '،'];
    $persian_letters = ['ی', 'ک', 'و', 'ه', '', ''];
    $string = str_replace($arabic_letters, $persian_letters, $string);

    // Farsi special character replace
    $specialCharacter = ['٬', '،', '؛', '‌', '؟', '', '؍'];
    $string = str_replace($specialCharacter, '', $string);

    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = preg_replace('/&#?[a-z0-9]+;/i', ' ', $string);
    $string = trim(preg_replace('/\s\s+/', ' ', $string));


    $string = persianNumberToEnglish($string);

    return $string;
}

function message($title = 'saved', $body = 'missionAccomplished', $type = 'success', $timer = true)
{
    if ($title == 'saved') {
        $title = 'ذخیره شد';
    }
    if ($body == 'missionAccomplished') {
        $body = 'عملیات با موفقیت انجام شد.';
    }

    session(['message.title' => $title, 'message.body' => $body, 'message.type' => $type, 'message.timer' => $timer]);
}

function numberFormattoInt($value)
{
    return intval(str_replace(',', '', $value));
}

function setting($name, $type = 'default')
{
    try {
        $result = cache("settings_$type")->where('name', $name)->first();
    } catch (Throwable $exception) {
        $result = setting::cache($type)->where('name', $name)->first();
    }

    try {
        if ($result->count()) {
            if ($result->type == 'file') {
                return $result;
            } elseif ($result->type == 'article' || $result->type == 'product' || $result->type == 'articleCategory' || $result->type == 'productCategory') {
                if (json_decode($result->value)) {
                    return json_decode($result->value);
                } else {
                    return [];
                }
            }
            return $result->value;
        }
    } catch (Throwable $exception) {
        return '';
    }
}

function flatten($arr, $childName = "allchildren", $isParent = false, $depth = 0)
{
    $result = [];
    foreach ($arr as $key => $item) {
        $item['level'] = $depth;
        if (isset($item[$childName])) {
            if ($isParent) {
                $item[$childName] = [$item[$childName]];
            }
            $result = array_merge($result, flatten($item[$childName], $childName, $isParent, $depth + 1));
            unset($item[$childName]);
        }
        $result[] = $item;
    }
    return $result;
}

function offerCalc($price, $offer)
{
    return ($price - ($price * ($offer / 100)));
}

function uniqname($suffix = '')
{
    $uniq = uniqid(Str::random(4)).str_replace('.', '', microtime(true));
    $hash = bin2hex(openssl_random_pseudo_bytes(16));
    return mb_strtolower($hash.$uniq.$suffix);
}

function offPrice($price, $percent)
{
    return ($price - ($price * ($percent / 100)));
}

function persianNumberToEnglish($matches)
{
    $farsi_array = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
    $english_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    return str_replace($farsi_array, $english_array, $matches);
}

function convertNumbers($matches)
{
    $farsi_array = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
    $english_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    return str_replace($farsi_array, $english_array, $matches);
}

function numberToMonth($value)
{
    $number = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    $month = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
    return str_replace($number, $month, $value);
}

function convertType($input)
{
    if ($input == 'true' || $input == 'false') {
        return (!!$input);
    } elseif ($input == 'null') {
        return null;
    } else {
        return $input;

    }
}

function str_limit($value, $limit = 100, $end = '...')
{
    return Str::limit($value, $limit, $end);
}

function kavenegar($message, $to, $isVerify = true, $type = 'sms')
{
    $apikey = '';
    $curl_handle = curl_init();
    if ($isVerify) {
        curl_setopt($curl_handle, CURLOPT_URL, "https://api.kavenegar.com/v1/$apikey/verify/lookup.json");
        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, [
            'template' => 'foodandteam',
            'receptor' => $to,
            'token' => $message,
        ]);
    } else {
        curl_setopt($curl_handle, CURLOPT_URL, "https://api.kavenegar.com/v1/$apikey/sms/send.json");
        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, [
            'receptor' => $to,
            'message' => $message,
        ]);
    }
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $query = curl_exec($curl_handle);
    curl_close($curl_handle);

    return response()->json(json_decode($query));
}

function smsMelipayamak($mobile, array $text, int $bodyId)
{
    ini_set("soap.wsdl_cache_enabled", "0");
    $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl", array("encoding" => "UTF-8"));
    $data = array(
        "username" => "piroozram",
        "password" => "158@MmoO0",
        "text" => $text,
        "to" => $mobile,
        "bodyId" => $bodyId,
    );
    $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
    return $send_Result;
}


function storeFile($name, $path)
{
    $request = request();
    $file = null;
    if ($request->hasFile($name)) {
        $file = $request->file($name)->store('uploads/'.$path);
    }
    return $file;
}

function updateFile($name, $path, $oldFileFullPath)
{
    $request = request();
    $file = $oldFileFullPath;
    if ($request->hasFile($name)) {
        if ($oldFileFullPath) {
            Storage::delete($oldFileFullPath);
        }
        $file = $request->file($name)->store('uploads/'.$path);
    }
    return $file;
}


function pictureGet($path, $size)
{
    return str_replace('.', "-$size.", $path);
}

function pictureStore($name, $path, $sizes = [200, 400, 600, 800])
{
    $request = request();
    $file = null;

    if ($request->hasFile($name)) {
        $uploadedFile = $request->file($name);
        $file = $uploadedFile->storeAs('uploads/'.$path, $uploadedFile->hashName(), 'local'); // ذخیره در public/storage
        $filePath = public_path( $file);


        if (!file_exists($filePath)) {
            throw new \Exception("فایل یافت نشد: " . $filePath);
        }

        $fileNameParts = pathinfo($file); // دریافت نام و پسوند فایل

        $manager = new ImageManager(new Driver());
        foreach ($sizes as $size) {
            $image = $manager->read($filePath) // خواندن تصویر
            ->scale(width: $size); // تغییر اندازه (حفظ نسبت)

            // ذخیره فایل جدید در public/storage/uploads
            $image->toJpeg()->save(public_path($fileNameParts['dirname'].'/'."{$fileNameParts['filename']}-{$size}.jpg"));
        }
    }

    return $file;
}

function pictureUpdate($name, $path, $oldFileFullPath)
{
    $request = request();
    $file = $oldFileFullPath;
    if ($request->hasFile($name)) {
        pictureDelete($oldFileFullPath);
        $file = pictureStore($name, $path);
    }
    return $file;
}

function pictureDelete($path, array $sizes = [200, 400, 600, 800])
{
    if ($path) {
        foreach ($sizes as $size) {
            Storage::delete(pictureGet($path, $size));
        }
        Storage::delete($path);
    }

    return 1;
}

function sharpenImage($image, $path)
{
    $gdImage = $image->getCore();
    $sumBrightness = 0;
    $pixelCount = 0;
    $width = imagesx($gdImage);
    $height = imagesy($gdImage);
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($gdImage, $x, $y);
            $colors = imagecolorsforindex($gdImage, $rgb);
            $brightness = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
            $sumBrightness += $brightness;
            $pixelCount++;
        }
    }
    $averageBrightness = $sumBrightness / $pixelCount;
    if ($averageBrightness < 128) {
        $image->sharpen(15);
        $image->contrast(8);
    } else {
        $image->sharpen(5);
        $image->contrast(2);
        $image->brightness(5);
    }
    $image->save($path);
}

function getNamePage($name = 'index')
{
    $routeName = request()->route()->getName();
    $parts = explode('.', $routeName);
    $parts[count($parts) - 1] = $name;
    return implode('.', $parts);
}

function curl_get_contents(
    $url,
    $post_data = [],
    $header = null,
    $verbose = false,
    $ref_url = false,
    $cookie_location = false,
    $return_transfer = true
) {
    $pointer = curl_init();

    curl_setopt($pointer, CURLOPT_URL, $url);
    curl_setopt($pointer, CURLOPT_TIMEOUT, 40);
    curl_setopt($pointer, CURLOPT_RETURNTRANSFER, $return_transfer);
    curl_setopt($pointer, CURLOPT_USERAGENT,
        "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.28 Safari/534.10");
    curl_setopt($pointer, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($pointer, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($pointer, CURLOPT_HEADER, false);
    curl_setopt($pointer, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($pointer, CURLOPT_AUTOREFERER, true);

    if ($header) {
        curl_setopt($pointer, CURLOPT_HTTPHEADER, $header);
    }

    if ($cookie_location !== false) {
        curl_setopt($pointer, CURLOPT_COOKIEJAR, $cookie_location);
        curl_setopt($pointer, CURLOPT_COOKIEFILE, $cookie_location);
        curl_setopt($pointer, CURLOPT_COOKIE, session_name().'='.session_id());
    }

    if ($verbose !== false) {
        $verbose_pointer = fopen($verbose, 'w');
        curl_setopt($pointer, CURLOPT_VERBOSE, true);
        curl_setopt($pointer, CURLOPT_STDERR, $verbose_pointer);
    }

    if ($ref_url !== false) {
        curl_setopt($pointer, CURLOPT_REFERER, $ref_url);
    }

    if ($post_data != []) {
        curl_setopt($pointer, CURLOPT_POST, true);
        curl_setopt($pointer, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($pointer, CURLOPT_POSTFIELDS, $post_data);
    }

    $return_val = curl_exec($pointer);

    $http_code = curl_getinfo($pointer, CURLINFO_HTTP_CODE);

    if ($http_code == 404) {
        return false;
    }

    curl_close($pointer);

    unset($pointer);

    return $return_val;
}


function mask_mobile_number($number): string
{
    return substr($number, 0, 5).'****'.substr($number, -2);
}

function logCreate(Exception $exception)
{
    errorLog::create([
        'route' => request()->route()->getName(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'message' => $exception->getMessage(),
    ]);
}

function getValidTitle($value)
{
    if ($value != '' && $value != null && $value != ' ') {
        return $value;
    }
    return 'ثبت نشده';
}
