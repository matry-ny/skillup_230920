<?php

namespace app\components;

use app\helpers\StringsHelper;

/**
 * Class Dispatcher
 * @package app\components
 */
class Dispatcher
{
    private const DEFAULT_CONTROLLER = 'index';
    private const DEFAULT_ACTION = 'index';

    /**
     * @var string
     */
    private string $address;

    /**
     * @var string
     */
    private string $separator;

    /**
     * @var string
     */
    private string $controller = '';

    /**
     * @var string
     */
    private string $action = '';

    /**
     * @var array
     */
    private array $params = [];

    /**
     * Dispatcher constructor.
     * @param string $address
     * @param string $separator
     */
    public function __construct(string $address, string $separator = '/')
    {
        $this->separator = $separator;
        $this->setAddress($address);

        $this->dispatch();
    }

    /**
     * @return string
     */
    public function getControllerPart(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getActionPart(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $address
     */
    private function setAddress(string $address): void
    {
        $getParamsStart = strpos($address, '?');
        if ($getParamsStart !== false) {
            $address = substr($address, 0, $getParamsStart);
        }

        $this->address = StringsHelper::trim($address, $this->separator);
    }

    private function dispatch(): void
    {
        $parts = explode($this->separator, StringsHelper::trim($this->address, $this->separator));

        $this->controller = array_shift($parts) ?: self::DEFAULT_CONTROLLER;
        $this->action = array_shift($parts) ?: self::DEFAULT_ACTION;

        $this->setParams($parts);
    }

    /**
     * @param array $parts
     */
    private function setParams(array $parts): void
    {
        $keys = [];
        $values = [];
        foreach ($parts as $index => $value) {
            if ($index % 2 === 0) {
                $keys[] = $value;
            } else {
                $values[] = $value;
            }
        }

        if (count($keys) > count($values)) {
            $values[] = null;
        }

        $this->params = array_merge(array_combine($keys, $values), $_GET);
    }
}
