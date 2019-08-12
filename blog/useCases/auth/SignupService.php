<?php

namespace blog\useCases\auth;

use blog\access\Rbac;
use blog\dispatchers\EventDispatcher;
use blog\entities\User\User;
use blog\forms\auth\SignupForm;
use blog\repositories\UserRepository;
use blog\services\TransactionManager;
use blog\services\RoleManager;
use DomainException;
use yii\mail\MailerInterface;

/**
 * Class SignupService
 * @package blog\useCases\auth
 */
class SignupService
{
    /** @var UserRepository */
    private $users;
    /** @var RoleManager */
    private $roles;
    /** @var TransactionManager */
    private $transaction;
    /** @var EventDispatcher */
    private $dispatcher;

    /**
     * SignupService constructor.
     * @param UserRepository $users
     * @param MailerInterface $mailer
     * @param RoleManager $roles
     * @param TransactionManager $transaction
     * @param EventDispatcher $dispatcher
     */
    public function __construct(
        UserRepository $users,
        MailerInterface $mailer,
        RoleManager $roles,
        TransactionManager $transaction,
        EventDispatcher $dispatcher
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param SignupForm $form
     * @throws \Exception
     */
    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password,
            $form->aboutMe
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });
    }

    /**
     * @param string $token
     */
    public function confirm(string $token): void
    {
        if (empty($token)) {
            throw new DomainException('Пустой токен');
        }

        $user = $this->users->findByEmailVerificationToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}