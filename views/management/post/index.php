<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a(Yii::t('app', 'New Post'), ['create'], ['class' => 'btn btn-xs btn-ghost btn-primary']) ?>
            </div>
        </div>
        <div class="content-block-body">
            <div class="wrapper-table">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-responsive'],
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'filterOptions' => ['width' => 75],
                            'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('id')],
                        ],
                        'title',
                        'categoryId',
                        'order',
                        'isVisible',
                        'alias',
                        // 'content:ntext',
                        // 'createdAt',
                        // 'updatedAt',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'filterOptions' => ['width' => 60],
                            'template' => '{update} {delete}',
                            'contentOptions' => ['data-title' => Yii::t('app', 'Actions')],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
