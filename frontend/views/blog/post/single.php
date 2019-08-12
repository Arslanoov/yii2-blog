<?php

/** @var $this yii\web\View */
/** @var $post blog\entities\Blog\Post\Post */
/** @var $cloud array */

use frontend\widgets\CommentsWidget;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Blog | ' . $post->getSeoTitle();
$this->registerMetaTag(['name' => 'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $post->meta->keywords]);

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug], ['target' => '_blank']);
}

?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v4.0"></script>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>

<?php $this->registerJsFile('/js/vk/comments.js') ?>

<div class="inner-banner">
    <div class="thm-container">
        <ul class="breadcumb">
            <li><a href="<?= Url::to(['/site/index']) ?>">Home</a></li>
            <li><span class="sep">-</span></li>
            <li><span class="page-name">Blog Details</span></li>
        </ul>
        <h3>Blog Details</h3>
    </div>
</div>

<section class="blog-details-page">
    <div class="thm-container">
        <div class="row">
            <div class="col-md-8">
                <div class="single-blog-details-content">
                    <div class="featured-img-box">
                        <?php if ($post->photo): ?>
                            <img src="<?= $post->getThumbFileUrl('photo', 'single') ?>" alt="">
                        <?php endif; ?>
                        <div class="date-box">
                            <?= date('d M', $post->created_at) ?>
                        </div>
                    </div>

                    <div class="text-box">
                        <h3><?= Html::encode($post->title) ?></h3>
                        <div class="meta-info">
                            <?php if ($post->author): ?>
                                By <a href="<?= Url::to(['/cabinet/default/view', 'id' => $post->author->id]) ?>" target="_blank"><?= Html::encode($post->author->username) ?></a>
                            <?php endif; ?>
                            <span class="sep">-</span>
                            <a href="#comments"><?= $post->comments_count ?> Comments</a>
                            <span class="sep">-</span>
                            <a href="#" onclick="false" class="like" data-post="<?= $post->id ?>">
                                <span id="likes_post_<?= $post->id ?>"><?= $post->likes ?></span>
                                <i class="fa fa-heart"></i>
                            </a>
                            <br>
                            Tags: <?= implode(', ', $tagLinks) ?>
                        </div>

                        <p><b><?= Html::encode($post->description) ?></b></p>

                        <br>

                        <p>
                            <?= Yii::$app->formatter->asHtml($post->content, [
                                'Attr.AllowedRel' => array('nofollow'),
                                'HTML.SafeObject' => true,
                                'Output.FlashCompat' => true,
                                'HTML.SafeIframe' => true,
                                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                            ]) ?>
                        </p>

                        <?php $link = 'http://blog.dev/blog/' . $post->id . '-' . $post->slug ?>

                        <div class="socials">
                            <div class="row">
                                <div class="col-sm-12">
                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?= Html::encode($link) ?>&layout=button_count&size=small&width=117&height=20&appId"
                                            width="117"
                                            height="20"
                                            style="border:none;overflow:hidden"
                                            scrolling="no"
                                            frameborder="0"
                                            allowTransparency="true"
                                            allow="encrypted-media">
                                    </iframe>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <script>
                                        document.write(VK.Share.button(false,{type: "round", text: "Save"}));
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="author-box clearfix">
                            <?php if ($post->author->photo): ?>
                                <div class="img-box">
                                    <img src="<?= $post->author->getThumbFileUrl('photo', 'single_post') ?>" alt="">
                                </div>
                            <?php endif; ?>

                            <div class="text-box">
                                <h3>
                                    <a href="<?= Url::to(['/cabinet/default/view', 'id' => $post->author->id]) ?>" target="_blank">
                                        <?= Html::encode($post->author->username) ?>
                                    </a>
                                </h3>
                                <p>
                                    <?= Html::encode($post->author->about_me) ?>
                                </p>
                            </div>
                        </div>

                        <?= CommentsWidget::widget([
                            'post' => $post
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?= $this->render('_sidebar', [
                    'cloud' => $cloud
                ]) ?>
            </div>

        </div>
    </div>
</section>

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
