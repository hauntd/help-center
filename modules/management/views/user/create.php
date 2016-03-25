<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\management\models\User */
/* @var $helper app\modules\management\components\ManagementHelper */

$this->title = Yii::t('app', 'New user');
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1 class="title"><?= Html::encode($this->title) ?></h1>
            <div class="pull-right">
                <?= Html::a('&larr; ' . Yii::t('app', 'Back to users'), ['index'],
                    ['class' => 'btn btn-xs btn-ghost btn-default btn-modal-close']) ?>
            </div>
        </div>
        <div class="content-block-body">
            <?= $this->render('_form', [
                'user' => $user,
                'helper' => $helper,
                'formId' => 'user-create-form',
            ]) ?>
        </div>
    </div>
</div>
