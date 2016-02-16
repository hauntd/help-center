<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
?>
<div class="container container-vertically-centered container-narrow">
    <div class="content-nav">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a(Yii::t('app', 'Sign in'), ['site/login']) ?></li>
            <li role="presentation" class="active"><?= Html::a(Yii::t('app', 'Sign up'), ['site/signup']) ?></li>
        </ul>
    </div>
    <div class="content-block">
        <div class="content-block-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
