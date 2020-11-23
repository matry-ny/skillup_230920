<?php

/**
 * Interface SecurableInterface
 */
interface SecurableInterface
{
    /**
     * @param bool $isDangerous
     * @return string
     */
    public function guard(bool $isDangerous): string;
}
