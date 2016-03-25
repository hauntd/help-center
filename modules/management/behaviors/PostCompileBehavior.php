<?php

namespace app\modules\management\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\helpers\HtmlPurifier;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\behaviors
 */
class PostCompileBehavior extends AttributeBehavior
{
    /** @var string */
    public $compiledAttribute = 'contentCompiled';

    /** @var string */
    public $contentAttribute = 'content';

    /** @var array */
    public $purifierConfig = [];

    /** @var string|callable */
    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->compiledAttribute,
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->compiledAttribute,
            ];
        }
    }

    /**
     * @param \yii\base\Event $event
     * @return string
     */
    protected function getValue($event)
    {
        return HtmlPurifier::process($this->owner->{$this->contentAttribute} , $this->purifierConfig);
    }

    /**
     * @param $attribute
     */
    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
    }
}
