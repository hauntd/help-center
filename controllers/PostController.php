<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers
 */
class PostController extends Controller
{
    /** @var string */
    public $layout = 'common';

    /**
     * Main page. Categories, most popular items etc.
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }
}
