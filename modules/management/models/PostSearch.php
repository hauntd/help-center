<?php

namespace app\modules\management\models;

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
    public $categoryTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoryId', 'sort', 'isVisible', 'createdAt', 'updatedAt'], 'integer'],
            [['alias', 'title', 'content', 'categoryTitle'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->joinWith(['category']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['categoryTitle'] = [
            'asc' => ['category.category' => SORT_ASC],
            'desc' => ['category.category' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'categoryId' => $this->categoryId,
            'sort' => $this->sort,
            'isVisible' => $this->isVisible,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'post.alias', $this->alias])
            ->andFilterWhere(['like', 'post.title', $this->title])
            ->andFilterWhere(['like', 'category.title', $this->categoryTitle]);

        return $dataProvider;
    }
}
