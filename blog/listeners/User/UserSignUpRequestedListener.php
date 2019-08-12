<?php

namespace blog\listeners\User;

use blog\entities\User\events\UserSignUpRequested;
use yii\mail\MailerInterface;
use RuntimeException;

/**
 * Class UserSignUpRequestedListener
 * @package blog\listeners\User
 */
class UserSignUpRequestedListener
{
    /** @var MailerInterface */
    private $mailer;

    /**
     * UserSignUpRequestedListener constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param UserSignUpRequested $event
     * @return void
     */
    public function handle(UserSignUpRequested $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('Подтверждение')
            ->send();

        if (!$sent) {
            throw new RuntimeException('Не удалось отправить сообщение на почту');
        }
    }
}