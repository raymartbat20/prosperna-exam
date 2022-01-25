<?php

namespace App\Services;

class Helper
{
    /**
     * Format number in money format
     * 
     * @param int $number
     * @param int $decimal places
     * @param string $decimal_seperator
     * @param string $seperator
     * 
     * @return string
     */
    public static function money_formatter($number,$decimal = 2, $decimal_seperator = ".", $seperator = ",")
    {
        return number_format($number,$decimal,$decimal_seperator,$seperator);
    }
}