<?php

namespace app\assets\url;

use yii\web\AssetBundle;

class UrlAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/url/style.css',
    ];
    public $js = [
        'js/url/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}