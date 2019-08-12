<?php

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>

<div class="content-wrapper">
    <section class="content-header">
        <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>

    <section class="content">
        <div class="margin-top-little">
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; 2019 Расуль Арсланов.</strong> Все права защищены.
</footer>