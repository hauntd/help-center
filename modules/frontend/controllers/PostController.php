<?php

namespace app\modules\frontend\controllers;

use app\components\WebController;
use app\modules\frontend\forms\SearchForm;
use app\modules\frontend\models\Category;
use app\modules\frontend\models\Post;
use app\modules\frontend\models\PostSearch;
use cebe\markdown\GithubMarkdown;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\frontend\controllers
 */
class PostController extends WebController
{
    /** @var string */
    public $layout = '@app/views/layouts/common';

    /**
     * Main page. Categories, most popular items etc.
     * @return string
     */
    public function actionIndex()
    {
        $results = [];
        $searchForm = new SearchForm();

        $this->layout = '@app/views/layouts/main.php';
        return $this->render('index', [
            'searchForm' => $searchForm,
            'results' => $results,
        ]);
    }

    /**
     * @param $categoryAlias
     * @param $postAlias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($categoryAlias, $postAlias)
    {
        $post = $this->findPost(['category.alias' => $categoryAlias, 'post.alias' => $postAlias]);
        $parser = new GithubMarkdown();
        $parser->html5 = true;
        $parser->enableNewlines = true;
        return $this->render('view', [
            'post' => $post,
            'content' => $parser->parse($post->content),
        ]);
    }

    /**
     * List posts by category
     * @param $categoryAlias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionByCategory($categoryAlias)
    {
        $category = Category::findOne(['alias' => $categoryAlias]);
        if ($category == null) {
            throw new NotFoundHttpException();
        }
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(['categoryAlias' => $categoryAlias]);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }

    public function actionSearch()
    {
    }

    /**
     * @param $condition
     * @return Post
     * @throws NotFoundHttpException
     */
    protected function findPost($condition)
    {
        $post = Post::find()
            ->where($condition)
            ->one();

        if ($post === null) {
            throw new NotFoundHttpException();
        }

        return $post;
    }
}
