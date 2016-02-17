<?php

namespace app\models;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $postId
 * @property integer $tagId
 */
class PostTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'postTag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postId', 'tagId'], 'required'],
            [['postId', 'tagId'], 'integer'],
            [['postId', 'tagId'], 'unique',
                'targetAttribute' => ['postId', 'tagId'],
                'message' => 'The combination of Post ID and Tag ID has already been taken.'
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
            'postId' => Yii::t('app', 'Post'),
            'tagId' => Yii::t('app', 'Tag'),
        ];
    }
}
