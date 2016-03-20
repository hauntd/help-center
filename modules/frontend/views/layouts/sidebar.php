<?php

use app\widgets\CategoriesWidget;

/** @var string $content */
/** @var \yii\web\View $this */

?>
<div class="content-block">
    <div class="content-block-body">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="sidebar-categories">
                    <h2><?= Yii::t('app', 'Categories') ?></h2>
                    <?= CategoriesWidget::widget([
                        'rootCategoryWrapperClass' => 'categories-block',
                        'rootCategoryClass' => 'category-root',
                        'childCategoryClass' => 'category-child',
                    ]) ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
