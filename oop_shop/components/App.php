<?php

namespace app\components;

use app\exceptions\InvalidConfigException;
use app\exceptions\NotFoundException;
use app\helpers\ArraysHelper;

/**
 * Class App
 * @package app\components
 */
class App
{
    /**
     * @var App|null
     */
    private static ?App $instance = null;

    private array $config;

    /**
     * @var Template|null
     */
    private ?Template $template = null;

    /**
     * App constructor.
     * @param array $config
     */
    private function __construct(array $config)
    {
        $this->config = $config;
    }

    private function __clone()
    {
    }

    /**
     * @param array $config
     * @throws InvalidConfigException
     */
    public static function init(array $config)
    {
        if (self::$instance !== null) {
            throw new InvalidConfigException('Application is initiated already');
        }

        self::$instance = new self($config);
        self::$instance->run();
    }

    /**
     * @return static
     * @throws InvalidConfigException
     */
    public static function get(): self
    {
        if (self::$instance === null) {
            throw new InvalidConfigException('Application is not initiated yet');
        }

        return self::$instance;
    }

    /**
     * @return Template
     * @throws InvalidConfigException
     */
    public function template(): Template
    {
        if ($this->template === null) {
            throw new InvalidConfigException('Template component is not initiated yet');
        }

        return $this->template;
    }

    private function run(): void
    {
        try {
            $this
                ->initDb()
                ->initTemplate()
                ->initRouter();
        } catch (InvalidConfigException $exception) {
            echo $exception->getMessage();
        } catch (NotFoundException $exception) {
            echo '404';
        }
    }

    /**
     * @return $this
     * @throws InvalidConfigException
     * @throws NotFoundException
     */
    private function initRouter(): self
    {
        if (!isset($this->config['controllerNamespace'])) {
            throw new InvalidConfigException('Key "controllerNamespace" is required');
        }

        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        new Router($dispatcher, $this->config['controllerNamespace']);

        return $this;
    }

    /**
     * @return $this
     * @throws InvalidConfigException
     */
    private function initDb(): self
    {
        $host = $this->getConfigValue('components.db.host');
        $user = $this->getConfigValue('components.db.user');
        $password = $this->getConfigValue('components.db.password');
        $name = $this->getConfigValue('components.db.name');

        return $this;
    }

    /**
     * @return $this
     * @throws InvalidConfigException
     */
    private function initTemplate(): self
    {
        $viewsDir = $this->getConfigValue('components.template.viewsDir');
        if (!$viewsDir) {
            throw new InvalidConfigException('Key "components.template.viewsDir" is required');
        }

        $layout = $this->getConfigValue('components.template.layout');
        if (!$layout) {
            throw new InvalidConfigException('Key "components.template.layout" is required');
        }

        $this->template = new Template($viewsDir, $layout);

        return $this;
    }

    /**
     * @param string $address
     * @return array|mixed|null
     */
    private function getConfigValue(string $address)
    {
        return ArraysHelper::find($address, $this->config);
    }
}