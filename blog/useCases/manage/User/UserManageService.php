<?php

namespace blog\useCases\manage\User;

use blog\entities\User\User;
use blog\forms\manage\User\UserCreateForm;
use blog\forms\manage\User\UserEditForm;
use blog\repositories\UserRepository;
use blog\services\TransactionManager;
use blog\services\RoleManager;
use DomainException;

class UserManageService
{
    private $users;
    private $roles;
    private $transaction;

    public function __construct(UserRepository $repository, RoleManager $roles, TransactionManager $transaction)
    {
        $this->users = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password,
            $form->aboutMe
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->transaction->wrap(function () use ($user, $form) {
            $this->users->save($user);
            $this->roles->assign($user->id, $form->role);
        });

        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->users->get($id);

        $user->edit(
            $form->username,
            $form->aboutMe
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->transaction->wrap(function () use ($user, $form) {
            $this->users->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function remove($id): void
    {
        $user = $this->users->get($id);
        $this->users->remove($user);
    }

    public function ban($id): void
    {
        $user = $this->users->get($id);
        $user->ban();
        $this->users->save($user);
    }

    public function unban($id): void
    {
        $user = $this->users->get($id);
        $user->unban();
        $this->users->save($user);
    }

    public function activate($id): void
    {
        $user = $this->users->get($id);
        $user->confirmSignup();
        $this->users->save($user);
    }

    public function draft($id): void
    {
        $user = $this->users->get($id);
        $user->draft();
        $this->users->save($user);
    }

    public function assignRole($id, $role): void
    {
        $user = $this->users->get($id);
        $this->roles->assign($user->id, $role);
    }
}