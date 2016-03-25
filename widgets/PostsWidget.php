<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets
 */
class PostsWidget extends Widget
{
    /* @var array */
    public $items;

    /** @var bool */
    public $renderCategories;

    /** @var bool */
    public $renderPreviews;

    /** @var string */
    public $postView;

    /** @var string */
    public $postPreview;

    /** @var string */
    public $emptyView;

    /**
     * @return string
     */
    public function run()
    {
        $classes = ['posts-widget'];
        if ($this->renderCategories) {
            $classes[] = 'with-categories';
        }
        if ($this->renderPreviews) {
            $classes[] = 'with-previews';
        }
        $output = Html::beginTag('div', ['class' => implode(' ', $classes)]);

        if (!count($this->items)) {
            return $this->renderEmpty();
        }

        foreach ($this->items as $item) {
            if ($item['category'] && $this->renderCategories) {
                $output .= Html::beginTag('div', ['class' => 'subcategory col-xs-12 col-sm-4']);
                $output .= Html::tag('h2', $item['category']->title);
            }
            $output .= $this->renderPosts($item['posts']);
            if ($item['category'] && $this->renderCategories) {
                $output .= Html::endTag('div');
            }
        }

        $output .= Html::endTag('div');

        return $output;
    }

    /**
     * @return string
     */
    private function renderEmpty()
    {
        return $this->view->render($this->emptyView);
    }

    /**
     * @param $posts
     * @return string
     */
    private function renderPosts($posts)
    {
        $output = '';
        foreach ($posts as $post) {
            $view = $this->renderPreviews ? $this->postPreview : $this->postView;
            $output .= $this->view->render($view, ['post' => $post]);
        }

        return $output;
    }
}
