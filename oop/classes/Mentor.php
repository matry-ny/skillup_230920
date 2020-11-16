<?php

declare(strict_types=1);

class Mentor extends Human
{
    public function checkHomework(): string
    {
        return 'tomorrow';
    }
}
