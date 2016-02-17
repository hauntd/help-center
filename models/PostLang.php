<?php

namespace app\models;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 *
 * @property integer $id
 * @property integer $postId
 * @property string $alias
 * @property string $language
 * @property string $title
 * @property string $content
 * @property integer $isVisible
 * @property integer $order
 * @property string $createdAt
 * @property string $updatedAt
 */
class PostLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'postLang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postId', 'alias', 'language', 'title', 'content'], 'required'],
            [['postId', 'isVisible', 'order'], 'integer'],
            [['content'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['alias', 'title'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 6],
            [['postId'], 'exist', 'skipOnError' => true,
                'targetClass' => Post::class,
                'targetAttribute' => ['postId' => 'id']
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
            'alias' => Yii::t('app', 'Alias'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'isVisible' => Yii::t('app', 'Visible'),
            'order' => Yii::t('app', 'Order'),
            'createdAt' => Yii::t('app', 'Created'),
            'updatedAt' => Yii::t('app', 'Updated'),
        ];
    }
}
