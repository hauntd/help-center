<?php

use yii\helpers\Html;

/* @var $post app\modules\frontend\models\Post */
/* @var $content string */

$this->title = Html::encode($post->title);
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>
<div class="post-title">
    <h1><?= Html::encode($post->title) ?></h1>
</div>
<div class="post-content">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
