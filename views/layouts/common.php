<?php
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;
/* @var $content string */
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="container <?= $this->params['container.class'] ?? null ?>">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<?php $this->endContent(); ?>
