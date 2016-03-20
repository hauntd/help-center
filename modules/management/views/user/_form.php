<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\modules\management\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $helper app\modules\management\components\ManagementHelper */
/* @var $formId string */
/* @var $buttons string[] */

$buttons = $buttons ?? [];

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => $formId]]); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'status')->dropDownList($helper->getUserStatuses()) ?>

    <?= $form->field($user, 'role')->dropDownList($helper->getUserRoles()) ?>

    <?= $form->field($user, 'newPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group form-actions">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if (count($buttons)): ?>
            <?php foreach ($buttons as $button) echo $button; ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
