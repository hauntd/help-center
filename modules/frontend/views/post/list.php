<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category app\modules\frontend\models\Category */

$this->title = Yii::t('app', 'Posts');
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>

<h1><?= Html::encode($category->title) ?></h1>
<?= ListView::widget([
    'options' => ['class' => 'list-view post-list-view'],
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}\n",
    'itemView' => function($post, $key, $index) {
        return $this->render('_post', [
            'post' => $post,
            'key' => $key,
            'index' => $index,
        ]);
    },
]); ?>
<?php $this->endContent(); ?>
