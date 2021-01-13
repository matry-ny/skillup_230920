<?php

namespace app\models\forms;

use PHPUnit\Framework\TestCase;

/**
 * Class LoginFormTest
 * @package app\models\forms
 *
 * @covers \app\models\forms\LoginForm
 */
class LoginFormTest extends TestCase
{
    private $loginForm;

    public function setUp(): void
    {
        $this->loginForm = new LoginForm();
    }

    public function testRules(): void
    {
        self::assertEquals($this->loginForm->rules(), [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ]);
    }
}
