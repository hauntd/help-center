<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post app\modules\management\models\Post */
/* @var $categories app\modules\management\models\Category[] */

$this->title = Yii::t('app', 'Update post');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to posts'), ['index'], ['class' => 'btn btn-xs btn-ghost btn-default']) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'post' => $post,
                'categories' => $categories,
                'formId' => 'post-update-form',
                'buttons' => [
                    Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $post->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ]
                    ]),
                ]
            ]) ?>
        </div>
    </div>
</div>
