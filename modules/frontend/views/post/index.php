<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $searchForm app\modules\frontend\forms\SearchForm */

$this->title = 'Help Center App';
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
            <div class="col-sm-3 categories-block">
                <a href="#" class="category-root">Category 1</a>
                <ul class="categories-children">
                    <li><a href="#">Category 1.1</a></li>
                    <li><a href="#">Category 1.2</a></li>
                    <li><a href="#">Category 1.3</a></li>
                    <li><a href="#">Category 1.4</a></li>
                    <li><a href="#">Category 1.5</a></li>
                </ul>
            </div>
            <div class="col-sm-3 categories-block">
                <a href="#" class="category-root">Category 2</a>
                <ul class="categories-children">
                    <li><a href="#">Category 2.1</a></li>
                    <li><a href="#">Category 2.2</a></li>
                    <li><a href="#">Category 2.3</a></li>
                    <li><a href="#">Category 2.4</a></li>
                    <li><a href="#">Category 2.5</a></li>
                </ul>
            </div>
            <div class="col-sm-3 categories-block">
                <a href="#" class="category-root">Category 3</a>
                <ul class="categories-children">
                    <li><a href="#">Category 3.1</a></li>
                    <li><a href="#">Category 3.2</a></li>
                    <li><a href="#">Category 3.3</a></li>
                    <li><a href="#">Category 3.4</a></li>
                    <li><a href="#">Category 3.5</a></li>
                </ul>
            </div>
            <div class="col-sm-3 categories-block">
                <a href="#" class="category-root">Category 3</a>
                <ul class="categories-children">
                    <li><a href="#">Category 3.1</a></li>
                    <li><a href="#">Category 3.2</a></li>
                    <li><a href="#">Category 3.3</a></li>
                    <li><a href="#">Category 3.4</a></li>
                    <li><a href="#">Category 3.5</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container homepage-popular">
    <div class="content-block">
        <div class="content-block-body clearfix row">
            <div class="col-xs-12 col-sm-6 homepage-popular-questions">
                <h4>Popular questions</h4>
                <p><a href="#">What is love? Baby dont hurt me, dont hurt me, no more</a></p>
                <p><a href="#">What is love? Baby dont hurt me, dont hurt me, no more</a></p>
                <p><a href="#">What is love? Baby dont hurt me, dont hurt me, no more</a></p>
                <p><a href="#">What is love? Baby dont hurt me, dont hurt me, no more</a></p>
                <p><a href="#">What is love? Baby dont hurt me, dont hurt me, no more</a></p>
            </div>
            <div class="col-xs-12 col-sm-6 homepage-popular-tags">
                <h4>Popular tags</h4>
                <a href="#" class="tag">#general</a>
                <a href="#" class="tag">#common</a>
                <a href="#" class="tag">#mail</a>
                <a href="#" class="tag">#options</a>
                <a href="#" class="tag">#payment</a>
                <a href="#" class="tag">#ship</a>
                <a href="#" class="tag">#notifications</a>
            </div>
        </div>
    </div>
</div>
