<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $category app\modules\management\models\Category */

$this->title = Yii::t('app', 'Update category');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to categories'), ['index'], [
                    'class' => 'btn btn-xs btn-ghost btn-default btn-modal-close'
                ]) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'category' => $category,
                'formId' => 'category-update-form',
                'buttons' => [
                    Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $category->id], [
                        'class' => 'btn btn-danger btn-category-delete',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ]
                    ]),
                ],
            ]) ?>
        </div>
    </div>
</div>
