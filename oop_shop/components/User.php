<?php


namespace app\components;

/**
 * Class User
 * @package app\components
 */
class User extends AbstractComponent
{
    /**
     * @var bool
     */
    private bool $isGuest = true;

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return $this->isGuest;
    }
}
