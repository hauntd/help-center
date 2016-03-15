<?php

namespace app\modules\management\models;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\models
 */
class Category extends \app\models\Category
{
    /**
     * @return array|null
     */
    public function getCategoriesTree()
    {
        $categories = Category::find()->orderBy('sort')->all();
        return $this->buildTree($categories);
    }

    /**
     * Build categories tree
     * @param $categories
     * @param null $parentId
     * @param int $level
     * @return array|null
     */
    private function buildTree($categories, $parentId = null, $level = 0)
    {
        $items = [];

        foreach ($categories as $category) {
            if ($category->parentId == $parentId) {
                $item = [
                    'id' => $category->id,
                    'label' => $category->title,
                    'alias' => $category->alias,
                    'parentId' => $category->parentId,
                    'sort' => $category->sort,
                    'isVisible' => $category->isVisible,
                ];
                $children = $this->buildTree($categories, $category->id, ++$level);
                if (count($children)) {
                    $item['children'] = $children;
                }
                $items[] = $item;
            }
        }

        return count($items) ? $items : null;
    }
}
