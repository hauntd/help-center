<?php

namespace app\modules\frontend\models;

use yii\db\ActiveQuery;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\frontend\models
 */
class Post extends \app\models\Post
{
    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return parent::find()
            ->joinWith(['category'])
            ->andWhere(['post.isVisible' => 1])
            ->andWhere(['category.isVisible' => 1])
            ->orderBy('sort');
    }
}
