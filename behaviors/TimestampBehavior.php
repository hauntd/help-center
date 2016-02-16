<?php

namespace app\behaviors;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\behaviors
 */
class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    /**
     * @var string
     */
    public $createdAtAttribute = 'createdAt';

    /**
     * @var string
     */
    public $updatedAtAttribute = 'updatedAt';
}
