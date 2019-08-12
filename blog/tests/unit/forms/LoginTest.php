<?php

namespace blog\tests\unit\forms;

use blog\forms\auth\LoginForm;
use Codeception\Test\Unit;
use common\fixtures\UserFixture;

class LoginTest extends Unit
{
    /** @var \common\tests\UnitTester */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testEmpty()
    {
        $model = new LoginForm([
            'username' => '',
            'password' => '',
        ]);

        expect_not($model->validate());
    }

    public function testRight()
    {
        $model = new LoginForm([
            'username' => 'testusername',
            'password' => '123456',
        ]);

        expect_that($model->validate());
    }

    public function testFail()
    {
        $model = new LoginForm([
            'username' => 'incorrectusername',
            'password' => 'incoreectpassword'
        ]);

        expect($model->getErrors());
    }
}