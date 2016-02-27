<?php

namespace app\models;

use app\behaviors\TimestampBehavior;
use paulzi\sortable\SortableBehavior;
use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $parentId
 * @property integer $sort
 * @property integer $isVisible
 * @property string $alias
 * @property string $title
 * @property string $createdAt
 * @property string $updatedAt
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * Init
     */
    public function init()
    {
        $this->isVisible = 1;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'sortable' => [
                'class' => SortableBehavior::class,
                'query' => ['parentId'],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'isVisible'], 'required'],
            [['parentId', 'isVisible', 'sort'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['alias'], 'required'],
            [['alias'], 'string', 'max' => 32],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentId' => Yii::t('app', 'Parent'),
            'alias' => Yii::t('app', 'Alias'),
            'isVisible' => Yii::t('app', 'Visible'),
            'title' => Yii::t('app', 'Title'),
            'createdAt' => Yii::t('app', 'Created'),
            'updatedAt' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return array|null
     */
    public function getCategoriesTree()
    {
        $categories = Category::find()->orderBy('sort')->all();
        return $this->buildTree($categories);
    }

    /**
     * Build categories tree
     * @param $categories
     * @param null $parentId
     * @param int $level
     * @return array|null
     */
    private function buildTree($categories, $parentId = null, $level = 0)
    {
        $items = [];

        foreach ($categories as $category) {
            if ($category->parentId == $parentId) {
                $item = [
                    'id' => $category->id,
                    'label' => $category->title,
                    'alias' => $category->alias,
                    'parentId' => $category->parentId,
                    'sort' => $category->sort,
                    'isVisible' => $category->isVisible,
                ];
                $children = $this->buildTree($categories, $category->id, ++$level);
                if (count($children)) {
                    $item['children'] = $children;
                }
                $items[] = $item;
            }
        }

        return count($items) ? $items : null;
    }
}
