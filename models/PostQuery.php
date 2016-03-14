<?php

namespace app\models;

use creocoder\taggable\TaggableQueryBehavior;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 */
class PostQuery extends \yii\db\ActiveQuery
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }
}
