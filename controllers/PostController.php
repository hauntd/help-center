<?php

namespace app\controllers;

use app\components\WebController;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers
 */
class PostController extends WebController
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
