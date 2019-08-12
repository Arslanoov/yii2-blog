<?php

/* @var $this yii\web\View */
/* @var $user \blog\entities\User\User */

use yii\helpers\Html;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);

?>

<div class="signup-confirm">
    <p>Hello, <?= Html::encode($user->username) ?>!</p>

    <p>To confirm your registration on the <a href="http://blog.dev"> blog.dev </a> website, follow the link:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

    If you did not send a request for registration on our website, then simply ignore this letter
</div>
