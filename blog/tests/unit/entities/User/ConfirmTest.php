<?php

namespace blog\tests\unit\entities\User;

use blog\entities\User\User;
use Codeception\Test\Unit;

class ConfirmTest extends Unit
{
    public function testSuccess()
    {
        $user = new User([
            'status' => User::STATUS_WAIT,
            'verification_token' => 'token'
        ]);

        $user->confirmSignup();

        $this->assertEmpty($user->verification_token);
        $this->assertTrue($user->isActive());
        $this->assertFalse($user->isWait());
    }
}