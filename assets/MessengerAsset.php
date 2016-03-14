<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\assets
 */
class MessengerAsset extends AssetBundle
{
    public $sourcePath = '@bower/messenger/build';
    public $css = [
        'css/messenger.css',
        'css/messenger-theme-flat.css',
    ];
    public $js = [
        'js/messenger.min.js',
        'js/messenger-theme-flat.js',
    ];
}
