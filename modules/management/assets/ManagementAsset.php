<?php

namespace app\modules\management\assets;

use yii\web\AssetBundle;
use app\assets\AppAsset;
use app\assets\jqTreeAsset;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\assets
 */
class ManagementAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/management/assets/static';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-tagsinput.css'
    ];
    public $js = [
        'js/bootstrap-tagsinput.min.js',
        'js/management.js',
        'js/management-categories.js',
    ];
    public $depends = [
        AppAsset::class,
        jqTreeAsset::class,
    ];
}
