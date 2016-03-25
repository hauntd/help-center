<?php

use app\widgets\CategoriesWidget;

/** @var string $content */
/** @var \yii\web\View $this */

?>
<div class="row">
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="content-block">
            <div class="content-block-header">
                <h2 class="title"><?= Yii::t('app', 'Categories') ?></h2>
            </div>
            <div class="content-block-body">
                <div class="sidebar-categories">
                    <?= CategoriesWidget::widget([
                        'rootCategoryWrapperClass' => 'categories-block',
                        'rootCategoryClass' => 'category-root',
                        'childCategoryClass' => 'category-child',
                        'showPostCount' => true,
                        'postCountClass' => 'category-post-count',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="content-block">
            <div class="content-block-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
