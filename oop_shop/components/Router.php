<?php

namespace app\components;

use app\exceptions\NotFoundException;
use app\helpers\StringsHelper;
use ReflectionException;
use ReflectionMethod;

/**
 * Class Router
 * @package app\components
 */
final class Router
{
    private const CONTROLLER_NAMESPACE = 'app\controllers';

    /**
     * @var Dispatcher
     */
    private Dispatcher $dispatcher;

    /**
     * @var string
     */
    private string $controllerNamespace;

    /**
     * Router constructor.
     * @param Dispatcher $dispatcher
     * @param string $controllerNamespace
     * @throws NotFoundException
     */
    public function __construct(Dispatcher $dispatcher, string $controllerNamespace)
    {
        $this->dispatcher = $dispatcher;
        $this->controllerNamespace = $controllerNamespace;

        $this->makeAction();
    }

    /**
     * @return string
     */
    private function prepareControllerName(): string
    {
        return sprintf(
            '%s\\%sController',
            $this->controllerNamespace,
            StringsHelper::camelize(
                $this->dispatcher->getControllerPart()
            )
        );
    }

    /**
     * @return string
     */
    private function prepareActionName(): string
    {
        $action = StringsHelper::camelize($this->dispatcher->getActionPart());
        return "action{$action}";
    }

    /**
     * Creates controller's instance and then makes selected action
     */
    private function makeAction(): void
    {
        $controllerClass = $this->prepareControllerName();
        if (!class_exists($controllerClass)) {
            throw new NotFoundException("Controller {$this->dispatcher->getControllerPart()} is undefined");
        }

        $controller = new $controllerClass();
        if (!$controller instanceof AbstractController) {
            throw new NotFoundException("Controller {$this->dispatcher->getControllerPart()} is invalid");
        }

        $action = $this->prepareActionName();
        if (!method_exists($controller, $action)) {
            throw new NotFoundException("Action {$this->dispatcher->getActionPart()} is undefined");
        }

        $params = $this->prepareParams($controller, $action, $this->dispatcher->getParams());
        $output = $controller->$action(...$params);

        if ($output && is_string($output)) {
            echo $output;
            exit;
        }
    }

    /**
     * @param AbstractController $controller
     * @param string $action
     * @param array $params
     * @return array
     * @throws ReflectionException
     */
    private function prepareParams(AbstractController $controller, string $action, array $params): array
    {
        $reflectionAction = new ReflectionMethod($controller, $action);
        $expectedParams = $reflectionAction->getParameters();

        $requiredParamsQuantity = $reflectionAction->getNumberOfRequiredParameters();

        $result = [];
        foreach ($expectedParams as $param) {
            if (array_key_exists($param->name, $params)) {
                $result[] = $params[$param->name];
            } elseif (count($result) >= $requiredParamsQuantity) {
                $result[] = null;
            } else {
                break;
            }
        }

        return $result;
    }
}
