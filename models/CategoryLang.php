<?php

namespace app\models;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $title
 * @property integer $isVisible
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Category $category
 */
class CategoryLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryLang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'isVisible'], 'integer'],
            [['title'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['categoryId' => 'id']
            ],
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
            'title' => Yii::t('app', 'Title'),
            'isVisible' => Yii::t('app', 'Visible'),
            'createdAt' => Yii::t('app', 'Created'),
            'updatedAt' => Yii::t('app', 'Updated'),
        ];
    }
}
