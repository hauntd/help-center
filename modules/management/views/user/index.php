<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\management\models\UserQuery */
/* @var $helper app\modules\management\components\ManagementHelper */

$this->title = Yii::t('app', 'Users');
$js = <<< 'JS'
$(document).ready(function() {
    var $body = $('body');
    $body.on('afterSubmit', '.user-form form', function(event) {
        $.pjax.reload({container: '#pjax-users'});
    });
});
JS;

$this->registerJs($js);
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a(Yii::t('app', 'Create user'), ['create'],
                    ['class' => 'btn btn-xs btn-ghost btn-primary btn-modal']) ?>
            </div>
        </div>
        <div class="content-block-body">
            <div class="wrapper-table">
                <?php Pjax::begin(['id' => 'pjax-users']); ?>
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
                                $helper->getUserStatuses(),
                                ['class' => 'form-control', 'prompt' => '']),
                            'value' => function ($data) use ($helper) {
                                return $helper->getStatusLabel($data);
                            },
                        ],
                        [
                            'attribute' => 'role',
                            'format' => 'raw',
                            'contentOptions' => ['data-title' => $searchModel->getAttributeLabel('role')],
                            'filter' => Html::activeDropDownList($searchModel, 'role',
                                $helper->getUserRoles(),
                                ['class' => 'form-control', 'prompt' => '']),
                            'value' => function($data) use ($helper) {
                                return $helper->getRoleLabel($data);
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'filterOptions' => ['width' => 60],
                            'template' => '{update} {delete}',
                            'contentOptions' => ['data-title' => Yii::t('app', 'Actions')],
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Update'),
                                        'aria-label' => Yii::t('yii', 'Update'),
                                        'data-pjax' => '0',
                                        'class' => 'btn-modal',
                                    ];
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                                },
                            ],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
