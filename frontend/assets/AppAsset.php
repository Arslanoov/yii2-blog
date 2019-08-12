<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/plugins/revolution/css/settings.css',
        '/plugins/revolution/css/layers.css',
        '/plugins/revolution/css/navigation.css',
        '/css/style.css',
        '/css/responsive.css'
    ];
    public $js = [
        '/js/jquery.js',
        '/js/bootstrap.min.js',
        '/js/bootstrap-select.min.js',
        '/js/jquery.validate.min.js',
        '/js/owl.carousel.min.js',
        '/js/isotope.js',
        '/js/jquery.magnific-popup.min.js',
        '/js/waypoints.min.js',
        '/js/jquery.counterup.min.js',
        '/js/wow.min.js',
        '/js/jquery.easing.min.js',
        '/js/custom.js',

        '/plugins/revolution/js/jquery.themepunch.revolution.min.js',
        '/plugins/revolution/js/jquery.themepunch.tools.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.actions.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.carousel.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.migration.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.navigation.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.parallax.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js',
        '/plugins/revolution/js/extensions/revolution.extension.video.min.js',
        '/js/main-slider-script.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
