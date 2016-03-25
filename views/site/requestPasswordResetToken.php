<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Request password reset');
$this->params['container.class'] = 'container-narrow';
?>
<div class="content-block">
    <div class="content-block-header">
        <h1 class="title"><?= Yii::t('app', 'Request password reset') ?></h1>
    </div>
    <div class="content-block-body">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
