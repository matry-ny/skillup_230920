<?php

namespace app\components;

/**
 * Class Template
 * @package app\components
 */
class Template
{
    /**
     * @var string
     */
    private string $viewsDir;
    /**
     * @var string
     */
    private string $defaultLayout;

    /**
     * Template constructor.
     * @param string $viewsDir
     * @param string $defaultLayout
     */
    public function __construct(string $viewsDir, string $defaultLayout)
    {
        $this->viewsDir = $viewsDir;
        $this->defaultLayout = $defaultLayout;
    }

    public function render(string $template, array $variables)
    {
        var_dump($template, $variables);
        exit;
    }
}
