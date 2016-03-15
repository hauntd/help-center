<?php

namespace app\controllers;

use app\components\WebController;
use app\forms\SearchForm;
use app\models\Post;
use Yii;

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
        $results = [];
        $searchForm = new SearchForm();
        $searchForm->query = Yii::$app->request->get('q');
        if ($searchForm->validate()) {
            $results = Post::find()
                ->where(['isVisible' => 1])
                ->andFilterWhere(['like', 'title', $searchForm->query])
                ->all();
        }

        $this->layout = '@app/views/layouts/main.php';
        return $this->render('index', [
            'searchForm' => $searchForm,
            'results' => $results,
        ]);
    }
}
