<?php

namespace common\bootstrap;

use blog\dispatchers\DeferredEventDispatcher;
use blog\dispatchers\EventDispatcher;
use blog\listeners\User\UserSignUpRequestedListener;
use blog\useCases\ContactService;
use blog\dispatchers\SimpleEventDispatcher;
use blog\listeners\User\UserSignUpConfirmedListener;
use yiidreamteam\upload\ImageUploadBehavior;
use blog\entities\behaviors\FlySystemImageUploadBehavior;
use Yii;
use yii\base\BootstrapInterface;
use yii\di\Container;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;
use blog\entities\User\events\UserSignUpRequested;
use blog\entities\User\events\UserSignUpConfirmed;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(EventDispatcher::class, DeferredEventDispatcher::class);
        $container->setSingleton(DeferredEventDispatcher::class, function (Container $container) {
            return new DeferredEventDispatcher(new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
            ]));
        });

        /*
           $container->setSingleton(Filesystem::class, function () use ($app) {
               return new Filesystem(new Ftp($app->params['ftp']));
           });
           $container->set(ImageUploadBehavior::class, FlySystemImageUploadBehavior::class);
       */

        return new SimpleEventDispatcher($container, [
            UserSignUpRequested::class => [UserSignupRequestedListener::class],
            UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
        ]);
    }
}