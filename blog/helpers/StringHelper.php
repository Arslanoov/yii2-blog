<?php

namespace blog\helpers;

/**
 * Class StringHelper
 * @package blog\helpers
 */
class StringHelper
{
    /**
     * @param $string
     * @param $length
     * @param $checkIsCutted
     * @return string
     */
    public static function cut($string, $length, $checkIsCutted = false): string
    {
        $cutted = substr($string, 0, $length);

        if ($checkIsCutted && strlen($cutted) < strlen($string)) {
            $cutted .= '...';
        }

        return $cutted;
    }
}