<?php

namespace app\modules\management\models;
use app\modules\management\behaviors\PostCompileBehavior;
use app\modules\management\behaviors\PreviewBehavior;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\management\models
 * @property Category $category
 */
class Post extends \app\models\Post
{
    /** @var string */
    public $categoryClass = Category::class;

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'preview' => [
                'class' => PreviewBehavior::class,
            ],
            'postCompile' => [
                'class' => PostCompileBehavior::class,
            ],
        ]);
    }
}
