<?php

/**
 * Class Magic
 *
 * @property int test
 * @property int[] qwerty
 *
 * @method void doSmth(int $a, int $b, int $c)
 */
class Magic
{
    private string $magicWord;

    private array $params = [];

    public function __construct(string $magicWord)
    {
        echo __METHOD__, PHP_EOL;
        $this->magicWord = $magicWord;
    }

    public function __set(string $name, $value): void
    {
        if (count($this->params) >= 3) {
            return;
        }
        $this->params[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }

    public function __isset($name): bool
    {
        return array_key_exists($name, $this->params);
    }

    public function __call($name, $arguments): void
    {
        echo "Called method {$name} with params ", json_encode($arguments), PHP_EOL;
    }

    public function __toString(): string
    {
        return serialize($this);
    }

    public function __destruct()
    {
        echo __METHOD__, PHP_EOL;
    }
}

$magic = new Magic('trah-tibidoh');
$magic->test = 123;
$magic->qwerty = [1, 2, 3];
$magic->tada = 'Boo';
$magic->ram = '1123';
var_dump($magic, $magic->test, isset($magic->test), isset($magic->qqq));
$magic->doSmth(1, 2, 4);
echo $magic, PHP_EOL;
