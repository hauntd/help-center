<?php

use yii\helpers\Html;
use app\widgets\PostsWidget;

/* @var $this yii\web\View */
/* @var $query string */
/* @var $category app\modules\frontend\models\Category */

$this->title = Yii::t('app', 'Posts');
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>

<h1 class="title"><?= Html::encode($category->title) ?></h1>
<div class="clearfix">
    <?= PostsWidget::widget([
        'items' => $items,
        'renderCategories' => $category->parentId == null,
        'renderPreviews' => $category->parentId != null,
        'postView' => '_post',
        'postPreview' => '_post_preview',
        'emptyView' => '_empty',
    ]); ?>
</div>
<?php $this->endContent(); ?>
