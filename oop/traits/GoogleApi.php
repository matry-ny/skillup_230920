<?php

trait GoogleApi
{
    private function makeTransaction(): void
    {
        echo "Google transaction is completed", PHP_EOL;
    }

    public function save(): void
    {
        echo 'Google saved', PHP_EOL;
    }
}
