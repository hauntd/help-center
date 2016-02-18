<?php

use app\helpers\ManagementHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
?>
<div class="content-block">
    <div class="content-block-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-xs btn-ghost btn-primary']) ?>
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
                    [
                        'attribute' => 'username',
                        'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('username')],
                    ],
                    [
                        'attribute' => 'email',
                        'format' => 'email',
                        'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('email')],
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('status')],
                        'filter' => Html::activeDropDownList($searchModel, 'status',
                            ManagementHelper::getUserStatuses(),
                            ['class' => 'form-control', 'prompt' => '']),
                        'value' => function ($data) {
                            return ManagementHelper::getStatusLabel($data);
                        },
                    ],
                    [
                        'attribute' => 'role',
                        'format' => 'raw',
                        'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('role')],
                        'filter' => Html::activeDropDownList($searchModel, 'role',
                            ManagementHelper::getUserRoles(),
                            ['class' => 'form-control', 'prompt' => '']),
                        'value' => function($data) {
                            return ManagementHelper::getRoleLabel($data);
                        },
                    ],
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
