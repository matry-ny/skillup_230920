<?php

class StaticTester
{
    public static int $count = 0;

    public function __construct()
    {
        self::incrementCounter();
    }

    private static function incrementCounter()
    {
        self::$count++;
    }
}

//StaticTester::$count = 4;
//StaticTester::test();

new StaticTester();
new StaticTester();
new StaticTester();
new StaticTester();
new StaticTester();

//var_dump(StaticTester::$count);

class Father
{
    public static function forward()
    {
        echo static::class, PHP_EOL;
    }

    public function __construct()
    {
        var_dump(self::class);
    }
}

class Child extends Father
{
    public static function back()
    {
        echo parent::class, PHP_EOL;
    }

    public function __construct()
    {
        parent::__construct();

        var_dump(self::class);
    }
}

Child::forward();
Child::back();

new Child();


class Singletone
{
    private static ?Singletone $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}

$object = Singletone::getInstance();
$object1 = Singletone::getInstance();

var_dump($object, $object1);
