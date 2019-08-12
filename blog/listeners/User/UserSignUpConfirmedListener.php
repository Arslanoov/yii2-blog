<?php

namespace blog\listeners\User;

use blog\entities\User\events\UserSignUpConfirmed;

class UserSignUpConfirmedListener
{
    /**
     * @param UserSignUpConfirmed $event
     * @return void
     */
    public function handle(UserSignUpConfirmed $event): void {}
}