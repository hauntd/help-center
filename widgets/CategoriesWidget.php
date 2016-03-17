<?php

namespace app\widgets;

use app\modules\frontend\models\Category;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets
 */
class CategoriesWidget extends Widget
{
    public function run()
    {
        $categories = Category::find()->all();
        echo $this->renderCategories($categories, null, 0);
    }

    /**
     * @param $categories
     * @param null $parentId
     * @param int $level
     * @return string
     */
    private function renderCategories($categories, $parentId = null, $level = 0)
    {
        $html = '';

        foreach ($categories as $category) {
            if ($category->parentId == $parentId) {
                if ($level == 0) {
                    $html .= Html::beginTag('div', ['class' => 'col-sm-3 categories-block']);
                    $html .= Html::a($category->title,
                        ['/frontend/post/by-category', 'categoryAlias' => $category->alias],
                        ['class' => 'category-root']);
                } else {
                    $html .= '<li>' .Html::a($category->title,
                            ['/frontend/post/by-category', 'categoryAlias' => $category->alias],
                            ['class' => 'category-child']) . '</li>';
                }
                $children = $this->renderCategories($categories, $category->id, $level + 1);
                if ($children) {
                    $html .= Html::tag('ul', $children, ['class' => 'categories-children']);
                }
                if ($level == 0) {
                    $html .= '</div>';
                }
            }

        }
        return $html;
    }
}
