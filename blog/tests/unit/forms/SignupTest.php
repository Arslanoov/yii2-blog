<?php

namespace blog\tests\unit\forms;

use blog\forms\auth\SignupForm;
use Codeception\Test\Unit;
use common\fixtures\UserFixture;

class SignupTest extends Unit
{
    /** @var \frontend\tests\UnitTester */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'user',
            'email' => 'email@gmail.com',
            'password' => '123456',
            'aboutMe' => 'Text..'
        ]);

        expect_that($model->validate());
    }

    public function testCorrectWithoutAboutme()
    {
        $model = new SignupForm([
            'username' => 'user',
            'email' => 'email@gmail.com',
            'password' => '123456'
        ]);

        expect_that($model->validate());
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'a',
            'email' => 'ababa',
            'password' => '1234'
        ]);

        expect_not($model->validate());

        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));
        expect_that($model->getErrors('password'));

        expect($model->getFirstError('username'))
            ->equals('Имя пользователя should contain at least 2 characters.');
        expect($model->getFirstError('email'))
            ->equals('E-mail is not a valid email address.');
    }
}