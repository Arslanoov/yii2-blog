<?php

/* @var $this yii\web\View */
/* @var $user \blog\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->verification_token]);

?>

Hello, <?= $user->username ?>!

To confirm your registration on the http://blog.dev website, follow the link:

<?= $confirmLink ?>

If you did not send a request for registration on our website, then simply ignore this letter