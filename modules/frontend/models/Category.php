<?php

namespace app\modules\frontend\models;

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
            ->andWhere(['isVisible' => 1])
            ->orderBy('sort');
    }
}
