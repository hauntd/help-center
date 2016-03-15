<?php

namespace app\modules\management;

use app\modules\management\components\ManagementHelper;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management
 * @property $helper ManagementHelper
 */
class Module extends \yii\base\Module
{
    /** @var ManagementHelper */
    protected $_helper;

    /**
     * Init
     */
    public function init()
    {
        parent::init();
        $this->_helper = new ManagementHelper();
    }

    /**
     * @return ManagementHelper
     */
    public function getHelper()
    {
        return $this->_helper;
    }
}
