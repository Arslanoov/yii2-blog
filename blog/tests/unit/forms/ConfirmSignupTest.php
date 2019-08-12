<?php

namespace blog\tests\unit\forms;

use blog\entities\User\User;
use blog\forms\auth\PasswordResetRequestForm;
use Codeception\Test\Unit;
use common\fixtures\UserFixture;

class ConfirmSignupTest extends Unit
{
    /** @var \frontend\tests\UnitTester */
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

    public function testWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'incorrect@example.com';

        expect_not($model->validate());
    }

    public function testInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);

        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];

        expect_not($model->validate());
    }

    public function testSuccess()
    {
        $userFixture = $this->tester->grabFixture('user', 0);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect($model->validate());
    }
}