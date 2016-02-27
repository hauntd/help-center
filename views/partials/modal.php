<?php

app\widgets\Modal::begin([
    'id' => 'modal',
    'options' => ['class' => 'modal-form fade'],
]);
?>
<div id="modal-content">
    <div class="modal-loader">
        <div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
    </div>
</div>
<?php app\widgets\Modal::end();
