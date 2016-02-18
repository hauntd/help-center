<?php

namespace app\models;

use creocoder\taggable\TaggableQueryBehavior;
use omgdef\multilingual\MultilingualTrait;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\models
 */
class PostQuery extends \yii\db\ActiveQuery
{
    use MultilingualTrait;

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
