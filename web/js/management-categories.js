var categories = {
    treeElement: null,
    init: function() {
        this.treeElement = $('#category-list');
        var el = this.treeElement;
        el.on('click', '.jqtree-update', function(event) {
            var nodeId = $(this).attr('data-node-id'),
                node = el.tree('getNodeById', nodeId);
        });
        el.on('click', '.jqtree-visible', function(event) {
            var a = $(this);
            $.ajax({
                url: a.attr('href'),
                method: 'post',
                success: function(data) {
                    if (data.success) {
                        if (data.isVisible) {
                            a.removeClass('toggle-off');
                            a.addClass('toggle-on');
                        } else {
                            a.removeClass('toggle-on');
                            a.addClass('toggle-off');
                        }
                    }
                }
            });
            event.preventDefault();
            return false;
        });
        el.on('click', '.jqtree-delete', function(event) {
            var nodeId = $(this).attr('data-node-id'),
                node = el.tree('getNodeById', nodeId);
            if (node) {
                bootbox.dialog({
                    title: app.t('app', 'Delete category'),
                    message: app.t('app', 'Are you sure you want to delete this item?'),
                    buttons: {
                        cancel: {
                            label: app.t('app', 'Cancel'),
                            className: 'btn-default',
                            callback: function() {
                                bootbox.hideAll();
                            }
                        },
                        danger: {
                            label: app.t('app', 'Delete'),
                            className: 'btn-danger',
                            callback: function() {
                                $.ajax({
                                    url: app.getUrl('management/category/delete') + '?id=' + node.id,
                                    data: {
                                        id: node.id
                                    },
                                    method: 'post',
                                    success: function(data) {
                                        if (data.success) {
                                            el.tree('removeNode', node);
                                            el.tree('reload');
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
        var requestParameters = {
            requestType: 'custom',
            type: 'post',
            url: app.getUrl('management/category/sort-items'),
            success: function(response) {
                if (response.success) {
                    el.tree('reload');
                }
            }
        };
        el.bind('tree.move', function(event) {
            var movedNode = event.move_info.moved_node,
                targetNode = event.move_info.target_node,
                position = event.move_info.position,
                requestData = {
                    CategorySortForm: {
                        movedNodeId: movedNode.id,
                        movedNodeParentId: movedNode.parentId,
                        targetNodeId: targetNode.id,
                        targetNodeParentId: targetNode.parentId,
                        moveTo: targetNode.sort > movedNode.sort ? 'moveDown' : 'moveUp',
                        position: position
                    }
                };
            if (position === "before") {
                if (movedNode.parentId === null) {
                    requestData.CategorySortForm.parentId = movedNode.parentId;
                    requestData.CategorySortForm.type = 'onlyMove';
                } else {
                    requestData.CategorySortForm.newParentId = null;
                    requestData.CategorySortForm.type = 'setParentAndMove';
                }
            }
            if (position === "after") {
                if (movedNode.parentId === targetNode.parentId) {
                    requestData.CategorySortForm.type = 'onlyMove';
                } else {
                    requestData.CategorySortForm.newParentId = targetNode.parentId;
                    requestData.CategorySortForm.type = 'setParentAndMove';
                }
            }
            if (position === "inside") {
                if (movedNode.parentId === targetNode.id) {
                    requestData.CategorySortForm.parentId = movedNode.parentId;
                    requestData.CategorySortForm.type = 'onlyMove';
                } else {
                    requestData.CategorySortForm.newParentId = targetNode.id;
                    requestData.CategorySortForm.type = 'setParentAndMove';
                }
            }
            requestParameters['data'] = requestData;
            $.ajax(requestParameters);
        });
    },
    display: function() {
        var options = {
            dragAndDrop: true,
            selectable: true,
            autoOpen: true,
            autoEscape: false,
            dataUrl: app.getUrl('management/category/get-data'),
            openedIcon: '&#xf107;',
            closedIcon: '&#xf105;',
            onCreateLi: function(node, li) {
                if (node.isEmpty) {
                    li.addClass('jqtree-empty');
                    return;
                }
                var deleteButton = $('<button/>').attr({
                    'data-node-id': node.id,
                    'type': 'button',
                    'title': app.t('app', 'Delete'),
                    'rel': 'tooltip',
                    'class': 'jqtree-delete btn btn-xs btn-ghost'
                }).html('<i class="fa fa-trash"></i>');
                var updateButton = $('<a/>').attr({
                    'data-node-id': node.id,
                    'type': 'button',
                    'title': app.t('app', 'Update'),
                    'rel': 'tooltip',
                    'href': app.getUrl('management/category/update?id=' + node.id),
                    'class': 'jqtree-update btn btn-xs btn-ghost btn-modal'
                }).html('<i class="fa fa-pencil"></i>');
                var visibilityButton = $('<a/>').attr({
                    'data-node-id': node.id,
                    'type': 'button',
                    'title': app.t('app', 'Toggle visibility'),
                    'rel': 'tooltip',
                    'href': app.getUrl('management/category/toggle?id=' + node.id),
                    'class': 'jqtree-visible btn btn-xs btn-ghost btn-toggle ' + (node.isVisible ? 'toggle-on' : 'toggle-off')
                }).html('<i class="fa fa-lightbulb-o"></i>');

                li.find('.jqtree-title').before('<i class="jqtree-move fa fa-ellipsis-v"></i>');
                li.find('.jqtree-title').before(deleteButton);
                li.find('.jqtree-title').before(updateButton);
                li.find('.jqtree-title').before(visibilityButton);
                li.find('.jqtree-title').append('<span class="jqtree-alias"> - ' + node.alias + '</i>');
            },
            onCanSelectNode: function(node) {
                return !node.isEmpty;
            },
            onCanMove: function(node) {
                return !node.isEmpty;
            },
            onCanMoveTo: function(movedNode, targetNode, position) {
                return !(targetNode.level && position === 'inside');
            }
        };
        this.treeElement.tree(options);
    },
    reload: function() {
        this.treeElement.tree('reload');
    }
};

$(document).ready(function() {
    var $body = $('body');

    categories.init();
    categories.display();

    $body.on('afterSubmit', '.category-form form', function(event) {
        categories.reload();
    });

});
