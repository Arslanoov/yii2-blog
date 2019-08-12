<?php

/* @var $this yii\web\View */
/* @var $user blog\entities\User\User */

use yii\helpers\Html;

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);

?>

<div class="password-reset">
    <p>Hello, <?= Html::encode($user->username) ?>!</p>

    <p>To recover the password on the site <a href="http://blog.dev">blog.dev</a>, you must follow the link:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    If you didn’t send a password reset request, just ignore this email.
</div>
