<?php

namespace app\components;

use app\exceptions\InvalidConfigException;

/**
 * Class AbstractSecuredController
 * @package app\components
 */
abstract class AbstractSecuredController extends AbstractController
{
    /**
     * AbstractSecuredController constructor.
     * @throws InvalidConfigException
     */
    public function __construct()
    {
        if (App::get()->user()->isGuest()) {
            $this->redirect('/guest/login');
        }
    }
}
