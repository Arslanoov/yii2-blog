<?php

namespace blog\tests\unit\forms;

use blog\forms\ContactForm;
use Codeception\Test\Unit;

class ContactTest extends Unit
{
    public function testSuccess()
    {
        $model = new ContactForm();

        $model->attributes = [
            'username' => 'username',
            'email' => 'email@gmail.com',
            'password' => '123456',
            'content' => 'Text..'
        ];

        expect_that($model->validate(['username', 'email', 'password', 'content']));
    }
}