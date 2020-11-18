<?php

class SkillUpException extends Exception
{
    public $message = 'SkillUp test exception';
    public $code = 237;
}

class ZeroException extends Exception
{
    public $message = 'Nomber is zero';
}

class ExceptionTester
{
    public function randomException(int $number)
    {
        if ($number === 0) {
            throw new ZeroException();
        }

        if ($number % 2 === 0) {
            throw new Exception("Number {$number} is even");
        }

        throw new SkillUpException();
    }
}

try {
    $number = random_int(0, 2);
    (new ExceptionTester())->randomException($number);
} catch (SkillUpException $exception) {
    var_dump('SkillUP');
    var_dump($exception->getMessage(), $exception->getCode(), $exception->getTrace());
} catch (ZeroException $exception) {
    var_dump('ZERO');
    var_dump($exception->getMessage(), $exception->getCode(), $exception->getTrace());
} catch (Exception $exception) {
    var_dump(get_class($exception));
    var_dump($exception->getMessage(), $exception->getCode(), $exception->getTrace());
} finally {
    echo 'Something in process now', PHP_EOL;
}

echo 'I am alive!!!!';
