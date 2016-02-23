$(document).ready(function() {

    var data = [
        {label: 'Vegetables', id: 1},
        {label: 'Fruites', id: 2, children: [
            {label: 'Apples', id: 3},
            {label: 'Oranges', id: 4}
        ]},
        {label: 'Trees', id: 5, children: [
            {label: 'Damn', id: 6},
            {label: 'Good stuff', id: 7}
        ]}
    ];

    $('#category-list').tree({
        data: data,
        autoOpen: true,
        dragAndDrop: true,
        openedIcon: '&#xf107;',
        closedIcon: '&#xf105;',
        onCreateLi: function(node, $li) {
            $li.find('.jqtree-title').before('<i class="jqtree-move fa fa-ellipsis-v"></i>');
        }
    });

});
