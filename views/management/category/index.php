<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $categories[] app\models\Category */
/* @var $category app\models\Category */

$this->title = Yii::t('app', 'Categories');
$data = Json::encode($categories, JSON_PRETTY_PRINT);
$dataUrl = \yii\helpers\Url::to(['get-data']);
$translations = [
    'cancelButton' => Yii::t('app', 'Cancel'),
    'deleteButton' => Yii::t('app', 'Delete'),
    'saveButton' => Yii::t('app', 'Save'),
    'createButton' => Yii::t('app', 'Create'),
    'deleteTitle' => Yii::t('app', 'Delete category'),
    'updateTitle' => Yii::t('app', 'Update category'),
    'createTitle' => Yii::t('app', 'New category'),
    'deleteText' => Yii::t('app', 'Are you sure you want to delete this item?'),
];
$urls = [
    'delete' => Url::to(['delete']),
];
$js = <<< JS
    var categories = $('#category-list');
    categories.tree({
        dataUrl: '$dataUrl',
        autoOpen: true,
        dragAndDrop: true,
        openedIcon: '&#xf107;',
        closedIcon: '&#xf105;',
        onCreateLi: function(node, li) {
            li.find('.jqtree-title').before('<i class="jqtree-move fa fa-ellipsis-v"></i>');
            li.find('.jqtree-title').before('<button data-node-id=' + node.id +
                ' type="button" class="jqtree-delete btn btn-xs btn-ghost"><i class="fa fa-trash"></i></button>');
            li.find('.jqtree-title').before('<button data-node-id=' + node.id +
                ' type="button" class="jqtree-edit btn btn-xs btn-ghost"><i class="fa fa-pencil"></i></button>');
            li.find('.jqtree-title').append('<span class="jqtree-alias"> - ' + node.alias + '</i>');
        }
    });
    categories.bind('tree.move', function(event) {
        console.log('---------------------------------------------------');
        console.log('moved_node', event.move_info.moved_node);
        console.log('target_node', event.move_info.target_node);
        console.log('position', event.move_info.position);
        console.log('previous_parent', event.move_info.previous_parent);
    });

    categories.on('click', '.jqtree-delete', function(event) {
        var nodeId = $(this).attr('data-node-id'),
            node = categories.tree('getNodeById', nodeId);
        if (node) {
            bootbox.dialog({
                title: "{$translations['deleteTitle']}",
                message: "{$translations['deleteText']}",
                 buttons: {
                    cancel: {
                      label: "{$translations['cancelButton']}",
                      className: "btn-default",
                      callback: function() {
                       bootbox.hideAll();
                      }
                    },
                    danger: {
                      label: "{$translations['deleteButton']}",
                      className: "btn-danger",
                      callback: function() {
                        $.ajax({
                            url: '{$urls['delete']}',
                            data: { id: node.id },
                            method: 'post',
                            success: function(data) {
                                if (data.success) {
                                    categories.tree('removeNode', node);
                                    categories.tree('reload');
                                }
                            }
                        });
                      }
                    }
                  }
            });
        }
        event.preventDefault();
        return false;
    });
JS;
$this->registerJs($js);
?>
<div class="row">
    <div class="content-block">
        <div class="content-block-header">
            <h1>Categories</h1>
            <div class="pull-right">
                <?= Html::button(Yii::t('app', 'New category'), ['class' => 'btn btn-xs btn-ghost btn-primary']) ?>
            </div>
        </div>
        <div class="content-block-body">
            <div id="category-list"><em><?= Yii::t('app', 'Loading...') ?></em></div>
        </div>
    </div>
</div>
