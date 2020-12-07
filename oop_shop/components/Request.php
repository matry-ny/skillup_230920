<?php

namespace app\components;

use app\helpers\ArraysHelper;

/**
 * Class Request
 * @package app\components
 */
class Request extends AbstractComponent
{
    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function post(string $key = '')
    {
        if ($key) {
            return ArraysHelper::find($key, $_POST);
        }

        return $_POST;
    }
}
