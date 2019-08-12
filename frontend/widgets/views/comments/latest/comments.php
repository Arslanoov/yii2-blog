<?php

/** @var $comments array */

?>

<?php foreach ($comments as $comment): ?>
    <?= $this->render('_comment', ['comment' => $comment]) ?>
<?php endforeach; ?>
