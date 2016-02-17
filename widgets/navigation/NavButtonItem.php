<?php

namespace app\widgets\navigation;

use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets\navigation
 */
class NavButtonItem extends \yii\base\Widget implements NavItemInterface
{
    /** @var string */
    public $content;

    /** @var string */
    public $url;

    /** @var array */
    public $buttonOptions = [];

    /** @var boolean */
    public $visible;

    /** @var string */
    public $type = 'default';

    /** @var string */
    public $tag = 'button';

    public function init()
    {
        if (!isset($this->buttonOptions['class'])) {
            $this->buttonOptions['class'] = 'btn btn-default btn-' . $this->type;
        }
        if (!isset($this->visible)) {
            $this->visible = true;
        }
    }

    /**
     * @return string
     */
    public function renderNavItem()
    {
        return '<li><p class="navbar-btn">' . Html::tag($this->tag, $this->content, $this->buttonOptions) . '</p></li>';
    }
}
