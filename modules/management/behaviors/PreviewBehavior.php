<?php

namespace app\modules\management\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\helpers\StringHelper;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\behaviors
 */
class PreviewBehavior extends AttributeBehavior
{
    /** @var string */
    public $previewAttribute = 'contentPreview';

    /** @var string */
    public $contentCompiled = 'content';

    /** @var int */
    public $length = 255;

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
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->previewAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->previewAttribute,
            ];
        }
    }

    /**
     * @param \yii\base\Event $event
     * @return string
     */
    protected function getValue($event)
    {
        $stripped = strip_tags($this->owner->{$this->contentCompiled});
        return StringHelper::truncate($stripped, $this->length, '...', null, true);
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
