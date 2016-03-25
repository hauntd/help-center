<?php

namespace app\modules\frontend\controllers;

use app\components\WebController;
use app\modules\frontend\forms\SearchForm;
use app\modules\frontend\models\Category;
use app\modules\frontend\models\Post;
use app\modules\frontend\models\PostSearch;
use cebe\markdown\GithubMarkdown;
use Yii;
use yii\helpers\ArrayHelper;
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
        $post = $this->findPost([
            'category.alias' => $categoryAlias,
            'post.alias' => $postAlias
        ]);

        return $this->render('view', [
            'post' => $post,
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
        /* @var Category $category */
        $postSearch = new PostSearch();
        $category = $this->findCategoryWithAlias($categoryAlias);
        $items = $postSearch->findPostsWithCategory($category);

        if (!count($items)) {
            throw new NotFoundHttpException(Yii::t('app', 'Posts not found'));
        }

        return $this->render('list', [
            'category' => $category,
            'items' => $items,
        ]);
    }

    public function actionSearch($query = null, $tag = null)
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
            throw new NotFoundHttpException(Yii::t('app', 'Post not found'));
        }

        return $post;
    }

    /**
     * @param $alias
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected  function findCategoryWithAlias($alias)
    {
        $category = Category::findOne(['alias' => $alias]);
        if ($category == null) {
            throw new NotFoundHttpException(Yii::t('app', 'Category not found'));
        }

        return $category;
    }
}
