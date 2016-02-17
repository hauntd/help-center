<?php

namespace app\widgets\navigation;

use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\navigation
 */
class Nav extends \yii\bootstrap\Nav
{
    /**
     * Renders widget items.
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if ($item instanceof NavItemInterface) {
                if ($item->visible) {
                    $items[] = $item->renderNavItem();
                }
            } else {
                if (isset($item['visible']) && !$item['visible']) {
                    continue;
                }
                $items[] = $this->renderItem($item);
            }
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }
}
