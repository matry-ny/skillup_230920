<?php

/**
 * Interface ScratchableInterface
 */
interface ScratchableInterface
{
    /**
     * @return string
     */
    public function scratch(): string;

    /**
     * @return int
     */
    public function getClawsCount(): int;
}
