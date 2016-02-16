<?php
/* @var $content string */
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container">
    <div class="wrapper">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
