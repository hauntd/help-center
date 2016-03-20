<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>

<div class="content-block-body">
    <div class="wrapper-table">
        <?php Pjax::begin(); ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function($post, $key, $index) {
                return $this->render('_post', [
                    'post' => $post,
                    'key' => $key,
                    'index' => $index,
                ]);
            },
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
<?php $this->endContent(); ?>
