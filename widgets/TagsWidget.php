<?php

namespace app\widgets;

use app\models\Tag;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\widgets
 */
class TagsWidget extends Widget
{
    /** @var int */
    public $count = 10;

    public function run()
    {
        $tags = Tag::find()
            ->joinWith(['postLinks'])->groupBy('tag.id')->limit($this->count)->orderBy('tag.frequency desc')->all();
        $output = '';
        foreach ($tags as $tag) {
            /* @var $tag Tag */
            $output .= Html::a('#' . $tag->tag, ['/frontend/post/search', 'tag' => $tag->tag], ['class' => 'tag']);
        }
        return $output;
    }
}
