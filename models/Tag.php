<?php

namespace app\models;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property string $tag
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['frequency'], 'integer'],
            [['tag'], 'string', 'max' => 255],
            [['tag'], 'unique'],
            ['frequency', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag' => Yii::t('app', 'Tag'),
            'frequency' => Yii::t('app', 'Frequency'),
        ];
    }

    /**
     * @return $this
     */
    public function getPostLinks()
    {
        return $this->hasMany(PostTag::class, ['tagId' => 'id']);
    }
}
