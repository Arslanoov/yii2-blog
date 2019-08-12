<?php

namespace blog\tests\unit\forms;

use blog\forms\auth\ResetPasswordForm;
use Codeception\Test\Unit;

class ResetPasswordTest extends Unit
{
    /** @var \frontend\tests\UnitTester */
    protected $tester;

    public function testCorrect()
    {
        $form = new ResetPasswordForm();
        $form->password = 'newpassword';
        expect_that($form->validate());
    }

    public function testFail()
    {
        $form = new ResetPasswordForm();
        $form->password = 'short';
        expect($form->getErrors());
    }
}