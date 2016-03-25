<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $category app\modules\management\models\Category */

$this->title = Yii::t('app', 'New category');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to categories'), ['index'], [
                    'class' => 'btn btn-xs btn-ghost btn-default btn-modal-close',
                    'data-id' => $category->id,
                ]) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'category' => $category,
                'formId' => 'category-create-form',
            ]) ?>
        </div>
    </div>
</div>
