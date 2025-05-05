<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convert($number)
    {
        $formatter = new \NumberFormatter('az', \NumberFormatter::SPELLOUT);
        $words = $formatter->format($number);

        return mb_ucfirst($words) . ' manat';
    }
}

// Capitalize first letter safely for UTF-8
if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($string, $encoding = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $encoding), $encoding)
            . mb_substr($string, 1, null, $encoding);
    }
}
