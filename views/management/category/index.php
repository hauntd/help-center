<?php

use app\assets\AppAsset;
use app\assets\jqTreeAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $categories[] app\models\Category */
/* @var $category app\models\Category */

$this->title = Yii::t('app', 'Categories');
$this->registerJsFile('@web/js/management-categories.js', ['depends' => AppAsset::class]);
jqTreeAsset::register($this);
?>
<div class="row">
    <div class="content-block content-block-categories">
        <div class="content-block-header">
            <h1>Categories</h1>
            <div class="pull-right">
                <?= Html::a(Yii::t('app', 'New category'), Url::to(['create']),
                    ['class' => 'btn btn-xs btn-primary btn-ghost btn-modal']); ?>
            </div>
        </div>
        <div class="content-block-body">
            <div id="category-list"><em><?= Yii::t('app', 'Loading...') ?></em></div>
            <div id="category-list-empty" style="display: none">No data</div>
        </div>
    </div>
</div>
