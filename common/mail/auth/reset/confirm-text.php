<?php

/* @var $this yii\web\View */
/* @var $user blog\entities\User\User */

$resetLink = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);

?>

<p>Hello, <?= $user->username ?>!</p>

To recover the password on the site http://blog.dev, you must follow the link:

<?= $resetLink ?>

If you didn’t send a password reset request, just ignore this email.