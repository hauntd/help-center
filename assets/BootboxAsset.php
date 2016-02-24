<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\assets
 */
class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootbox.js';
    public $js = [
        'bootbox.js',
    ];
}
