<?php

namespace app\modules\frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\models
 */
class PostSearch extends Post
{
    /** @var string */
    public $query;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['query'], 'string', 'min' => 1, 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param Category $category
     * @return array
     */
    public function findPostsWithCategory(Category $category)
    {
        $subCategories = Category::findAll(['category.parentId' => $category->id]);
        $ids = [$category->id];
        foreach ($subCategories as $subCategory) {
            $ids[] = $subCategory->id;
        }
        $query = $this->find();
        $query->orderBy('category.sort');
        $query->andWhere(['in', 'post.categoryId', $ids]);

        if (!$this->validate()) {
            return [];
        }
        $query->andFilterWhere(['like', 'title', $this->query])
            ->andFilterWhere(['like', 'content', $this->query]);

        $items = [];
        foreach ($query->all() as $post) {
            /* @var $post Post */
            $items[$post->category->alias]['category'] = $post->category;
            $items[$post->category->alias]['posts'][] = $post;
        }

        return $items;
    }

    public function findPostsWithQuery($query)
    {
    }
}
