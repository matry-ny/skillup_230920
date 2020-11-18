<?php

class Properties
{
    public int $p1 = 1;
    public int $p2 = 2;
    public int $p3 = 3;
    public int $p4 = 4;
    private int $p5 = 5;
    private int $p6 = 6;

    public function iterate()
    {
        foreach ($this as $property => $value) {
            echo "{$property} => {$value}", PHP_EOL;
        }
    }
}

$properties = new Properties();
$properties->iterate();
