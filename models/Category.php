<?php

namespace app\models;

use app\behaviors\TimestampBehavior;
use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $parentId
 * @property string $alias
 * @property integer $isVisible
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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId', 'isVisible'], 'integer'],
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
}
