<?php

namespace app\helpers;

/**
 * Class ArraysHelper
 * @package app\helpers
 */
class ArraysHelper
{
    /**
     * @param string $address
     * @param array $data
     * @param mixed $default
     * @return array|mixed|null
     */
    public static function find(string $address, array $data, $default = null)
    {
        $keys = explode('.', $address);
        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                return $default;
            }
        }

        return $data;
    }
}