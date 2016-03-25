<?php

use yii\helpers\Html;

/* @var $post app\modules\frontend\models\Post */

$this->title = Html::encode($post->title);
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>
<div class="post-title">
    <h1 class="title"><?= Html::encode($post->title) ?></h1>
</div>
<div class="post-content">
    <?= $post->contentCompiled ?>
</div>
<?php $this->endContent(); ?>
