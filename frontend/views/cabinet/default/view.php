<?php

/** @var $this yii\web\View */
/** @var $user blog\entities\User\User */

use yii\helpers\Html;
use yii\helpers\Url;
use blog\helpers\StringHelper;

$this->title = 'User | ' . Html::encode($user->username);

$postsCount = $user->getPosts()->count();
$posts = $user->posts;
$comments = $user->comments;

?>

<section class="section">
    <div class="thm-container">
        <div class="row">

            <?php if ($user->photo): ?>
                <div class="col-md-4">
                    <p>
                        <span class="photo-box">
                            <img src="<?= $user->getThumbFileUrl('photo', 'thumb') ?>" alt="">
                        </span>
                    </p>
                </div>
            <?php endif; ?>

            <div class="col-md-4">
                <div class="text-left">
                    <h1><?= Html::encode($user->username) ?></h1>
                    <p><?= date('d-M-Y h:i:s', $user->created_at) ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <h2>About me</h2>
                <p><?= Html::encode($user->about_me) ?></p>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <h2><?= Html::encode($user->username) ?>'s posts:</h2>

                <?php foreach ($posts as $post): ?>
                    <h3><a href="<?= Url::to(['/blog/post/single', 'id' => $post->id, 'slug' => $post->slug]) ?>" target="_blank"><?= Html::encode($post->title) ?></a></h3>
                <?php endforeach; ?>
            </div>
            <div class="col-md-6">
                <h2><?= Html::encode($user->username) ?>'s comments:</h2>

                <?php foreach ($comments as $comment): ?>
                    <h3><a href="<?= Url::to(['/blog/post/single', 'id' => $comment->post->id, 'slug' => $comment->post->slug, '#' => 'comment_' . $comment->post->id]) ?>" target="_blank"><?= Html::encode(StringHelper::cut($comment->text, 70, true)) ?></a></h3>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>