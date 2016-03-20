<?php

namespace app\modules\frontend;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\frontend
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        Yii::setAlias('frontend', dirname(__FILE__));
    }
}
