$(function() {
    //菜单树处理
    $('#bt_index_menu_tree').tree({
        data: _MENUDATA_,
        lines: true,
        onSelect: function(node) {
            if (node.attributes.issort == 1) {
                $(this).tree('unSelect', node.target);
            } else {
                $('#bt_index_layout_center').panel('setTitle', node.text);
                $('#bt_index_layout_center').panel('refresh', _ROOT_ + node.attributes.href);
            }
        }
    });

    //主题切换
    $('.theme').click(function() {
        var themeName = $(this).attr('name');
        $('#bt_index_theme_link').attr('href', _THEME_PATH_ + '/' + themeName + '/easyui.css');
    });

    $('#bt_index_control_menu_lock').click(_systemLock);
});

var _openNewWindow = function() {
    var opt = $('#bt_index_layout_center').panel('options');
    $("#bt_jump_page_title").val(opt.title);
    $('#bt_jump_form').attr('action', _ROOT_ + opt.href).submit();
};

var _systemLock = function() {
    var w = $.dialog({
        title: '锁定',
        href: _ROOT_ + '/index/lock',
        closable: false,
        draggable: false,
        bodyStyle: {overflow: 'hidden'},
        width: 220,
        height: 150,
        buttons: [
            {
                text: '解锁',
                handler: function() {
                    var pwd = $.trim($('#bt_index_control_lock_pwd').val());
                    if (pwd) {
                        $.post(_ROOT_ + '/index/unlock', {pwd: pwd}, function(rsp) {
                                if(rsp.status){
                                    w.close();
                                }else{
                                    $.alert(rsp.msg);
                                }
                        }, "JSON");
                    }
                }
            }
        ]
    });
};

