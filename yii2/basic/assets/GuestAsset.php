<?php
namespace app\assets;

use yii\web\YiiAsset;
use yii\web\AssetBundle;
use yii\bootstrap\BootstrapAsset;

class GuestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/guest.css',
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}
