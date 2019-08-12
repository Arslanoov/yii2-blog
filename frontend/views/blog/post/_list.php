<?php

use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

?>

<?php Pjax::begin() ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'itemView' => '_post',
    ]) ?>

    <?= LinkPager::widget([
        'pagination' => $dataProvider->getPagination(),
        'options' => [
            'class' => 'pagination clearfix'
        ],
        'activePageCssClass' => 'active-page',
        'disabledPageCssClass' => 'none'
    ]) ?>

<?php Pjax::end() ?>

<?php $this->registerJs("
    $('.like').click(function () {
        var postId = $(this).data('post');
    
        $.ajax({
            url: '/blog/post/like',
            type: 'GET',
            data: {postId: postId},
            success: function (data) {
                $('#likes_post_' + postId).html(data);
            }
        });
    
        return false;
    });")
?>
