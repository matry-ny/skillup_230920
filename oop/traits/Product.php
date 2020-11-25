<?php


class Product
{
    use GoogleApi, YandexTrait {
        GoogleApi::makeTransaction insteadof YandexTrait;
        GoogleApi::save as googleSave;
        GoogleApi::makeTransaction as makeGoogleTransaction;
        YandexTrait::makeTransaction as makeYandexTransaction;
    }

    public function sale(): void
    {
        $this->makeYandexTransaction();
        $this->makeGoogleTransaction();
        echo 'Product was sold', PHP_EOL;
        $this->googleSave();
        $this->save();
    }

    public function save(): void
    {
        echo 'Object saved', PHP_EOL;
    }
}
