<?php

/** @var $this yii\web\View */
/** @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use blog\helpers\PageHelper;
use blog\readModels\PageReadRepository;

AppAsset::register($this);

$pageHelper = new PageHelper(new PageReadRepository());

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">

    <link rel="shortcut icon" href="/img/favicon/apple-icon-180x180.png" type="image/x-icon">

    <title><?= Html::encode($this->title) ?></title>

    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="preloader">
    <div class="spinner"></div>
</div>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>