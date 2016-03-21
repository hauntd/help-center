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

    /** @var string */
    public $categoryAlias;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['query', 'categoryAlias'], 'string', 'min' => 1, 'max' => 255],
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ]);

        $this->setAttributes($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andWhere(['category.alias' => $this->categoryAlias]);
        $query->andFilterWhere(['like', 'title', $this->query])
            ->andFilterWhere(['like', 'content', $this->query]);

        return $dataProvider;
    }
}
