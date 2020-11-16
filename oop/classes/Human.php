<?php

declare(strict_types=1);

class Human
{
    public const BIOLOGIC = 'human';

    private string $name = '';
    private int $age = 0;

    protected array $memory = [];

    public function breathe($air): string
    {
        if (!array_key_exists('breathes', $this->memory)) {
            $this->memory['breathes'] = 0;
        }
        $this->memory['breathes']++;

        return 'CO2';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * Method for getting result of codding
     * @return string
     */
    public function writeCode(): string
    {
        return 'Make money';
    }
}
