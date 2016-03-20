<?php

use yii\helpers\Html;

/* @var $post app\modules\frontend\models\Post */

?>
<div class="post-item">
    <?= Html::a($post->title,
        ['/frontend/post/view', 'categoryAlias' => $post->category->alias, 'postAlias' => $post->alias],
        ['class' => 'post-item-link']
    ); ?>
</div>
