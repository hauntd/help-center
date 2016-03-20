<?php

namespace app\modules\management;

use Yii;
use app\modules\management\components\ManagementHelper;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management
 * @property $helper ManagementHelper
 */
class Module extends \yii\base\Module
{
    /** @var string */
    public $controllerNamespace = 'app\modules\management\controllers';

    /** @var ManagementHelper */
    protected $_helper;

    /**
     * Init
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('management', dirname(__FILE__));
        $this->registerHelper();
        $this->registerTranslations();
    }

    /**
     * Registers management helper class
     */
    public function registerHelper()
    {
        if (!isset($this->_helper)) {
            $this->_helper = new ManagementHelper();
        }
    }

    /**
     * @return ManagementHelper
     */
    public function getHelper()
    {
        return $this->_helper;
    }

    /**
     * Registers module translations
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['management'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/management/messages',
        ];
    }

    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/management/' . $category, $message, $params, $language);
    }
}
