<?php

namespace app\components;

use app\exceptions\InvalidConfigException;
use app\exceptions\NotFoundException;

/**
 * Class AbstractController
 * @package app\components
 */
abstract class AbstractController
{
    /**
     * @param string $template
     * @param array $variables
     * @param string|null $layout
     * @return string
     * @throws InvalidConfigException
     * @throws NotFoundException
     */
    protected function render(string $template, array $variables = [], ?string $layout = null): string
    {
        return App::get()->template()->render($template, $variables, $layout);
    }

    /**
     * @param string $address
     * @param int $status
     * @param bool $terminate
     */
    protected function redirect(string $address, int $status = 302, bool $terminate = true): void
    {
        header("Location: {$address}", true, $status);
        if ($terminate) {
            exit;
        }
    }

    /**
     * @return Request
     * @throws InvalidConfigException
     */
    protected function request(): Request
    {
        return App::get()->request();
    }
}
