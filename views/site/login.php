<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['container.class'] = 'container-narrow';
?>
<div class="content-nav">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><?= Html::a(Yii::t('app', 'Sign in'), ['site/login']) ?></li>
        <li role="presentation"><?= Html::a(Yii::t('app', 'Sign up'), ['site/signup']) ?></li>
    </ul>
</div>
<div class="content-block">
    <div class="content-block-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div style="color:#999;margin:1em 0">
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
        </div>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
