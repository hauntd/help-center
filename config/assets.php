<?php

return [
    'jsCompressor' => 'java -jar tools/compiler.jar --js {from} --js_output_file {to}',
    'cssCompressor' => 'java -jar tools/yuicompressor.jar --type css {from} -o {to}',
    'bundles' => [
        yii\web\YiiAsset::class,
        yii\web\JqueryAsset::class,
        yii\bootstrap\BootstrapAsset::class,
        yii\bootstrap\BootstrapPluginAsset::class,
    ],
    // Asset bundle for compression output:
    'targets' => [
        'libs' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'libs.min.js',
            'css' => 'libs.min.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
    ],
];
