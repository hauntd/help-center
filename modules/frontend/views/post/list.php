<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category app\modules\frontend\models\Category */

$this->title = Yii::t('app', 'Posts');
$this->beginContent('@frontend/views/layouts/sidebar.php');
?>

<?php Pjax::begin(); ?>
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
<?php Pjax::end(); ?>
<?php $this->endContent(); ?>
