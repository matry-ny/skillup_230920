<?php

namespace app\components;

use app\exceptions\NotFoundException;

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
     * @var string
     */
    public string $content = '';

    /**
     * @var array
     */
    public array $variables = [];

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

    /**
     * @param string $template
     * @param array $variables
     * @return string
     * @throws NotFoundException
     */
    public function render(string $template, array $variables): string
    {
        $this->variables = $variables;
        $this->content = $this->includeTemplate($template);
        return $this->includeTemplate($this->defaultLayout);
    }

    /**
     * @param string $template
     * @return string
     * @throws NotFoundException
     */
    private function includeTemplate(string $template): string
    {
        $templateFile = "{$this->viewsDir}/{$template}.php";
        if (!file_exists($templateFile)) {
            throw new NotFoundException("Template {$template} is undefined");
        }

        ob_start();
        require $templateFile;
        return ob_get_clean();
    }
}
