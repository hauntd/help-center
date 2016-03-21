<?php

namespace app\modules\frontend\models;

use yii\db\ActiveQuery;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\frontend\models
 */
class Category extends \app\models\Category
{
    /**
     * @return ActiveQuery
     */
    public static function find()
    {
        return parent::find()
            ->andWhere(['category.isVisible' => 1])
            ->orderBy('category.sort');
    }
}
