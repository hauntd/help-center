<?php

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\widgets\navigation\Nav;
use app\widgets\navigation\NavSearchItem;

NavBar::begin([
    'brandLabel' => Html::encode(Yii::$app->name),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-fixed-top '. ($this->params['navbar.class'] ?? 'navbar-default'),
    ],
]);

$rightMenu = [
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        new NavSearchItem([
            'action' => ['/search'],
            'method' => 'get',
            'name' => 'query',
            'inputOptions' => [
                'autocomplete' => 0,
                'placeholder' => Yii::t('app', 'Search'),
                'class' => 'form-control',
            ],
            'visible' => $this->params['navbar.search.hidden'] ?? true,
        ]),
        ['label' => 'Topics', 'url' => ['/']],
    ],
];
if (Yii::$app->user->isGuest) {
    $rightMenu['items'][] = ['label' => 'Sign up', 'url' => ['/site/signup']];
    $rightMenu['items'][] = ['label' => 'Log in', 'url' => ['/site/login']];
} else {
    $rightMenu['items'][] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
}
echo Nav::widget($rightMenu);

NavBar::end();
