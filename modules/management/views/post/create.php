<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post app\modules\management\models\Post */
/* @var $categories app\modules\management\models\Category[] */

$this->title = Yii::t('app', 'New Post');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to Posts'), ['index'], [
                    'class' => 'btn btn-xs btn-ghost btn-default btn-modal-close',
                    'data-id' => $post->id,
                ]) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'post' => $post,
                'categories' => $categories,
                'formId' => 'post-create-form',
            ]) ?>
        </div>
    </div>
</div>
