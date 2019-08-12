<?php

namespace blog\repositories;

use blog\dispatchers\EventDispatcher;
use blog\entities\User\User;
use RuntimeException;

/**
 * Class UserRepository
 * @package blog\repositories
 */
class UserRepository
{
    /** @var EventDispatcher */
    private $dispatcher;

    /**
     * UserRepository constructor.
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username): User
    {
        return $this->getBy([
            'username' => $username
        ]);
    }

    /**
     * @param string $value
     * @return User|null
     */
    public function findByUsernameOrEmail(string $value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User
    {
        return $this->getBy([
            'email' => $email,
        ]);
    }

    /**
     * @param string $token
     * @return User
     */
    public function findByEmailVerificationToken(string $token)
    {
        return $this->getBy([
            'verification_token' => $token
        ]);
    }

    /**
     * @param $network
     * @param $identity
     * @return User|null
     */
    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    /**
     * @param string $token
     * @return User
     */
    public function findByPasswordResetToken(string $token): User
    {
        return $this->getBy([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @param string $token
     * @return bool
     */
    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new RuntimeException('Saving Error');
        }

        $this->dispatcher->dispatchAll($user->releaseEvents());
    }

    /**
     * @param User $user
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new RuntimeException('Removing Error');
        }

        $this->dispatcher->dispatchAll($user->releaseEvents());
    }

    /**
     * @param array $condition
     * @return User
     */
    private function getBy(array $condition): User
    {
        if (!($user = User::find()->where($condition)->limit(1)->one())) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }
}