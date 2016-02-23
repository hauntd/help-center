<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\assets
 */
class jqTreeAsset extends AssetBundle
{
    public $sourcePath = '@bower/jqtree';
    public $js = [
        'tree.jquery.js',
    ];
}
