<?php

namespace app\widgets\navigation;

use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets\navigation
 */
class NavSearchItem extends \yii\base\Widget implements NavItemInterface
{
    /** @var string */
    public $action;

    /** @var string */
    public $method = 'post';

    /** @var array */
    public $formOptions = [];

    /** @var string */
    public $name;

    /** @var string */
    public $value;

    /** @var array */
    public $inputOptions;

    /** @var array */
    public $buttonOptions;

    /** @var boolean */
    public $visible = true;

    public function init()
    {
        if (!isset($this->inputOptions)) {
            $this->inputOptions = ['class' => 'form-control input-sm'];
        }
        if (!isset($this->buttonOptions)) {
            $this->buttonOptions = ['class' => 'btn btn-default', 'type' => 'submit'];
        }
        Html::addCssClass($this->formOptions, 'navbar-form');
        $this->formOptions['role'] = 'search';
    }

    /**
     * @return string
     */
    public function renderNavItem()
    {
        $output = '<li>' . Html::beginForm($this->action, $this->method, $this->formOptions) . '<div class="input-group">';
        $output .= Html::input('text', $this->name, $this->value, $this->inputOptions);
        $output .= '<div class="input-group-btn">';
        $output .= Html::button('<i class="glyphicon glyphicon-search"></i>', $this->buttonOptions);
        $output .= '</div></div>' . Html::endForm() . '</li>';

        return $output;
    }
}
