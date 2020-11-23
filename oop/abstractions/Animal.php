<?php

/**
 * Class Animal
 */
abstract class Animal
{
    /**
     * @var string
     */
    public string $gender;

    public function __construct(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    abstract public function makeSound(): string;
}
