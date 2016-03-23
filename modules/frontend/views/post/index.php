<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\CategoriesWidget;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $searchForm app\modules\frontend\forms\SearchForm */

$this->title = Yii::$app->name;
$this->params['navbar.search.visible'] = false;
$this->params['navbar.class'] = 'navbar-default navbar-homepage';
?>
<div class="homepage">
    <div class="container">
        <div class="homepage-search">
            <?php $form = ActiveForm::begin(); ?>
            <?= Html::activeTextInput($searchForm, 'query', [
                'class' => 'form-control query',
                'placeholder' => Yii::t('app', 'What can we help you with?'),
            ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="homepage-categories">
            <?= CategoriesWidget::widget([
                'rootCategoryWrapperClass' => 'col-xs-12 col-sm-3 categories-block',
                'rootCategoryClass' => 'category-root',
                'childCategoryClass' => 'category-child',
            ]) ?>
        </div>
    </div>
</div>
<div class="container homepage-popular">
    <div class="content-block">
        <div class="content-block-body clearfix row">
            <div class="col-xs-12 col-sm-6 homepage-popular-questions">
                <h4>Popular questions</h4>
                <p><a href="#">What is Help-Center and how I can use it</a></p>
                <p><a href="#">How can you help us</a></p>
                <p><a href="#">Technical details of the application</a></p>
                <p><a href="#">Installation</a></p>
                <p><a href="#">Demo</a></p>
            </div>
            <div class="col-xs-12 col-sm-6 homepage-popular-tags">
                <h4>Popular tags</h4>
                <a href="#" class="tag">#general</a>
                <a href="#" class="tag">#common</a>
                <a href="#" class="tag">#mail</a>
                <a href="#" class="tag">#options</a>
                <a href="#" class="tag">#tech</a>
                <a href="#" class="tag">#plugins</a>
            </div>
        </div>
    </div>
</div>
