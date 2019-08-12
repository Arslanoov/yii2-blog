<?php

namespace blog\tests\unit\entities\User;

use Codeception\Test\Unit;
use blog\entities\User\User;

class SignupTest extends Unit
{
    public function testSuccess()
    {
        $user = User::requestSignup(
            $username = 'username',
            $email = 'email@gmail.com',
            $password = '123456',
            $aboutMe = 'Text...'
        );

        $this->assertEquals($user->username, $username);
        $this->assertEquals($user->email, $email);
        $this->assertNotEquals($user->password_hash, $password);
        $this->assertEquals($user->about_me, $aboutMe);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->updated_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->verification_token);
        $this->assertTrue($user->isWait());
        $this->assertFalse($user->isActive());
    }
}