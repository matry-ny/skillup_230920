<?php

namespace app\components;

/**
 * Class AbstractController
 * @package app\components
 */
abstract class AbstractController
{
    /**
     * @param string $template
     * @param array $variables
     * @return string
     * @throws \app\exceptions\InvalidConfigException
     * @throws \app\exceptions\NotFoundException
     */
    public function render(string $template, array $variables): string
    {
        return App::get()->template()->render($template, $variables);
    }
}
