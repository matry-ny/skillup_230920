<?php

declare(strict_types=1);

class Student extends Human
{
    public function makeHomework(): string
    {
        $days = random_int(1, 10);
        $date = (new DateTime('now'))->modify("+{$days} day")->format('Y-m-d');

        $this->memory['homework'] = $date;

        return $date;
    }

    public function writeCode(): string
    {
        return 'Accept experience';
    }
}
