<?php

/**
 * Class Dog
 */
class Dog extends Animal implements ScratchableInterface, SecurableInterface
{
    /**
     * @inheritDoc
     */
    public function makeSound(): string
    {
        return 'Woof';
    }

    /**
     * @inheritDoc
     */
    public function scratch(): string
    {
        $result = '';
        for ($i = 1; $this->getClawsCount() >= $i; $i++) {
            $result .= "Scratch #{$i} ";
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getClawsCount(): int
    {
        return 5;
    }

    /**
     * @inheritDoc
     */
    public function guard(bool $isDangerous): string
    {
        if ($isDangerous) {
            return "!!!{$this->makeSound()}!!!";
        }

        return '';
    }
}
