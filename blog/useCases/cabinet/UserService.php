<?php

namespace blog\useCases\cabinet;

use blog\repositories\UserRepository;

class UserService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function delete($id, $static): void
    {
        $user = $this->users->get($id);
        $this->users->remove($user);
    }
}