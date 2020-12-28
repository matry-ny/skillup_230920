<?php

namespace app\assets;

use yii\web\YiiAsset;
use yii\web\AssetBundle;
use yii\bootstrap\BootstrapAsset;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}