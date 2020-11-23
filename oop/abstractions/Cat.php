<?php

/**
 * Class Cat
 */
class Cat extends Animal implements ScratchableInterface
{
    /**
     * @inheritDoc
     */
    public function makeSound(): string
    {
        return 'Myau';
    }

    /**
     * @inheritDoc
     */
    public function scratch(): string
    {
        return "{$this->getClawsCount()} Scratches and {$this->makeSound()}";
    }

    /**
     * @inheritDoc
     */
    public function getClawsCount(): int
    {
        return 5;
    }
}
