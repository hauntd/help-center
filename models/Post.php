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
            'ml' => [
                'class' => MultilingualBehavior::class,
                'languages' => Yii::$app->params['siteLanguages'],
                'languageField' => 'language',
                'requireTranslations' => false,
                'langClassName' => PostLang::class,
                'defaultLanguage' => Yii::$app->params['siteLanguagesDefault'],
                'langForeignKey' => 'postId',
                'tableName' => "{{%postLang}}",
                'attributes' => [
                    'title', 'content',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'required'],
            [['categoryId', 'isVisible'], 'integer'],
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
