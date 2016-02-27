<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $category app\models\Category */
/* @var $form yii\widgets\ActiveForm */
/* @var $formId string */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['id' => $formId]]); ?>

    <?= $form->errorSummary($category) ?>
    <?= $form->field($category, 'title')->textInput() ?>
    <?= $form->field($category, 'alias')->textInput() ?>
    <?= $form->field($category, 'isVisible')->checkbox() ?>

    <div class="form-group form-actions">
        <?= Html::submitButton($category->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
