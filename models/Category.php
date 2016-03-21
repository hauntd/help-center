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
    /** @var integer */
    public $postCount;

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
            [['parentId', 'isVisible', 'sort', 'postCount'], 'integer'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['categoryId' => 'id']);
    }
}
