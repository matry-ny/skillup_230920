<?php

namespace app\helpers;

/**
 * Class StringsHelper
 * @package app\helpers
 */
class StringsHelper
{
    /**
     * @param string $subject
     * @param string $symbols
     * @return string
     */
    public static function trim(string $subject, string $symbols = ''): string
    {
        return trim($subject, " \t\n\r\0\x0B{$symbols}");
    }
}
