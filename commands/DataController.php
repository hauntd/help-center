<?php

namespace app\commands;

use app\models\Category;
use app\models\Post;
use yii\console\Controller;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\commands
 */
class DataController extends Controller
{
    public function actionIndex()
    {
        if (!$this->confirm('Remove all data and insert demo data?')) {
            return false;
        }
        Category::deleteAll();
        $categories = [
            ['id' => 1, 'alias' => 'general',  'title' => 'General'],
            ['id' => 2, 'alias' => 'general-about', 'title' => 'About this script', 'parentId' => 1],
            ['id' => 3, 'alias' => 'general-faq', 'title' => 'F.A.Q.', 'parentId' => 1],
            ['id' => 4, 'alias' => 'cat13', 'title' => 'Category 1.3', 'parentId' => 1],
            ['id' => 5, 'alias' => 'cat14', 'title' => 'Category 1.4', 'parentId' => 1],
            ['id' => 6, 'alias' => 'cat15', 'title' => 'Category 1.5', 'parentId' => 1],
            ['id' => 7, 'alias' => 'cat2',  'title' => 'Category 2'],
            ['id' => 8, 'alias' => 'cat21', 'title' => 'Category 2.1', 'parentId' => 7],
            ['id' => 9, 'alias' => 'cat22', 'title' => 'Category 2.2', 'parentId' => 7],
            ['id' => 10, 'alias' => 'cat23', 'title' => 'Category 2.3', 'parentId' => 7],
            ['id' => 11, 'alias' => 'cat3',  'title' => 'Category 3'],
            ['id' => 12, 'alias' => 'cat31', 'title' => 'Category 3.1', 'parentId' => 11],
            ['id' => 13, 'alias' => 'cat32', 'title' => 'Category 3.2', 'parentId' => 11],
            ['id' => 14, 'alias' => 'cat33', 'title' => 'Category 3.3', 'parentId' => 11],
        ];
        foreach ($categories as $item) {
            $model = new Category();
            $model->setAttributes($item, false);
            $model->save();
        }
        Post::deleteAll();
        $posts = [
            ['title' => 'Post 1 - 1', 'alias' => 'post11', 'categoryId' => 1],
            ['title' => 'Post 1 - 2', 'alias' => 'post12', 'categoryId' => 1],
            ['title' => 'Post 1 - 3', 'alias' => 'post13', 'categoryId' => 1],
            ['title' => 'Post 1 - 4', 'alias' => 'post14', 'categoryId' => 1],

            ['title' => 'Post 1.1 - 1', 'alias' => 'post111', 'categoryId' => 2],
            ['title' => 'Post 1.1 - 2', 'alias' => 'post112', 'categoryId' => 2],
            ['title' => 'Post 1.1 - 3', 'alias' => 'post113', 'categoryId' => 2],
            ['title' => 'Post 1.1 - 4', 'alias' => 'post113', 'categoryId' => 2],

            ['title' => 'Post 1.2 - 1', 'alias' => 'post121', 'categoryId' => 3],
            ['title' => 'Post 1.2 - 2', 'alias' => 'post122', 'categoryId' => 3],
            ['title' => 'Post 1.2 - 3', 'alias' => 'post123', 'categoryId' => 3],

            ['title' => 'Post 1.3 - 1', 'alias' => 'post131', 'categoryId' => 4],
            ['title' => 'Post 1.3 - 2', 'alias' => 'post132', 'categoryId' => 4],
            ['title' => 'Post 1.3 - 3', 'alias' => 'post133', 'categoryId' => 4],
        ];
        foreach ($posts as $item) {
            $model = new Post();
            $model->setAttributes($item, false);
            $model->save(false);
        }
        $this->printTree(Category::find()->all());
    }

    /**
     * Build categories tree
     * @param $categories
     * @param null $parentId
     * @param int $level
     * @return array|null
     */
    private function printTree($categories, $parentId = null, $level = 0)
    {
        $items = [];

        foreach ($categories as $category) {
            if ($category->parentId == $parentId) {
                printf("%s %s\n", str_repeat('-', $level), $category->alias);
                $this->printTree($categories, $category->id, $level + 1);
            }
        }

        return count($items) ? $items : null;
    }
}
