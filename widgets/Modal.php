<?php

namespace app\widgets;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets
 */
class Modal extends \yii\bootstrap\Modal
{
    /** @var bool */
    public $showHeader = false;

    /**
     * Disable
     * @return null
     */
    public function renderHeader()
    {
        if ($this->showHeader) {
            parent::renderHeader();
        }

        return null;
    }
}
