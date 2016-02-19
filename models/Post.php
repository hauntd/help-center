<?php

namespace app\models;

use Yii;
use creocoder\taggable\TaggableBehavior;
use omgdef\multilingual\MultilingualBehavior;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $categoryId
 * @property integer $isVisible
 * @property string $alias
 * @property string $language
 * @property string $title
 * @property string $content
 * @property integer $order
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Category $category
 * @property string $tagValues
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @return PostQuery
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function behaviours()
    {
        return [
            'taggable' => [
                'class' => TaggableBehavior::class,
                'tagValueAttribute' => 'tag',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'alias', 'title', 'content'], 'required'],
            [['categoryId', 'isVisible', 'order'], 'integer'],
            [['content'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['alias', 'title'], 'string', 'max' => 255],
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
            'categoryId' => Yii::t('app', 'Category'),
            'isVisible' => Yii::t('app', 'Visible'),
            'alias' => Yii::t('app', 'Alias'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'order' => Yii::t('app', 'Order'),
            'createdAt' => Yii::t('app', 'Created'),
            'updatedAt' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    /**
     * @return $this
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tagId'])
            ->viaTable('{{%postTag}}', ['postId' => 'id']);
    }
}
