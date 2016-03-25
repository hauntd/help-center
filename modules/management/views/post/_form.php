<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use vova07\imperavi\Widget as Editor;

/* @var $this yii\web\View */
/* @var $post app\modules\management\models\Post */
/* @var $categories app\modules\management\models\Category[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $formId string */
/* @var $buttons array */

$buttons = $buttons ?? [];

?>

<div class="post-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => $formId]]); ?>
    <?= $form->field($post, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($post, 'alias')->textInput(['maxlength' => true]) ?>
    <?= $form->field($post, 'categoryId')->dropDownList(ArrayHelper::map($categories, 'id', 'title')) ?>
    <?= $form->field($post, 'isVisible')->checkbox() ?>
    <?= $form->field($post, 'content')->widget(Editor::class, [
        'settings' => [
            'minHeight' => 200,
            'buttons' => [
                'format', 'bold', 'italic', 'deleted', 'lists', 'image', 'file', 'link', 'horizontalrule',
            ],
            'plugins' => [
                'clips',
                'fullscreen',
            ],
            'imageUpload' => Url::to(['/management/post/image-upload'])
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton($post->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => 'btn btn-primary']) ?>
        <?php if (count($buttons)): ?>
            <?php foreach ($buttons as $button) echo $button; ?>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
