<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'New User');
?>
<div class="content-block">
    <div class="content-block-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="pull-right">
            <?= Html::a('&larr; ' . Yii::t('app', 'Back to users'), ['index'], ['class' => 'btn btn-xs btn-ghost btn-default']) ?>
        </div>
    </div>
    <div class="content-block-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
