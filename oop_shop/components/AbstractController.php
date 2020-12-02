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
     * @param string|null $layout
     * @return string
     * @throws \app\exceptions\InvalidConfigException
     * @throws \app\exceptions\NotFoundException
     */
    public function render(string $template, array $variables = [], ?string $layout = null): string
    {
        return App::get()->template()->render($template, $variables, $layout);
    }
}
