<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post app\modules\management\models\Post */
/* @var $categories app\modules\management\models\Category[] */

$this->title = Yii::t('app', 'Update Post');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to Posts'), ['index'], ['class' => 'btn btn-xs btn-ghost btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $post->id], [
                    'class' => 'btn btn-xs btn-ghost btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ]]) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'post' => $post,
                'categories' => $categories,
                'formId' => 'post-update-form',
            ]) ?>
        </div>
    </div>
</div>
