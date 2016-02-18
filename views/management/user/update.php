<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = sprintf('%s: %s', Yii::t('app', 'Update user'), $model->username);
?>
<div class="content-block">
    <div class="content-block-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="pull-right">
            <?= Html::a('&larr; ' . Yii::t('app', 'Back to users'), ['index'], ['class' => 'btn btn-xs btn-ghost btn-default']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-xs btn-ghost btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ]]) ?>
        </div>
    </div>
    <div class="content-block-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
