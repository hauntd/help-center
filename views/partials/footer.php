<?php

use yii\helpers\Html;

?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= sprintf('%s %s', Html::encode(Yii::$app->name), date('Y')) ?></p>
    </div>
</footer>
