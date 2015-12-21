<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:48:33
         compiled from "./Application/Home/View\Sys\function_list.html" */ ?>
<?php /*%%SmartyHeaderCode:277155672147156e3a9-11610610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3546d577ce8a3bb7f99e28309b44b996b357e1e' => 
    array (
      0 => './Application/Home/View\\Sys\\function_list.html',
      1 => 1434444551,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277155672147156e3a9-11610610',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_567214715cbfc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567214715cbfc')) {function content_567214715cbfc($_smarty_tpl) {?><div class="easyui-layout" fit="true">
    <div region="center" title="功能列表" id="bt_function_laout_center"><table id="bt_function_grid"></table></div>
    <div region="west" style="width: 200px;" title="菜单" split='true'>
        <ul id="bt_function_menu_tree"></ul>
    </div>
</div>
<script type="text/javascript"> NameSpace("BT.function", function() { var context = this; var $grid = $('#bt_function_grid');
var viewDialog;
var selectedMenuId, selectedMenuText;

context.ready = function() {
    $grid.datagrid({
        fit: true,
        border: false,
        idField:'function_id',
        url: _ROOT_ + '/sys/functionData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'text', title: '名称', width: 100, align: 'center'},
                {field: 'resources', title: '资源', width: 300},
                {field: 'relegation', title: '归属', width: 150, align: 'center'},
                {field: 'function_id', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="编辑" class="img-btn icon-edit" function_id=' + value + '></span>';
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: context.addView
            }, {
                text: '删除',
                iconCls: 'icon-remove',
                handler: context.doDelete
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[function_id]').click(function(e) {
                e.stopPropagation();
                var function_id = $(this).attr('function_id');
                context.updateView(function_id);
            });
        }
    });

    $('#bt_function_menu_tree').tree({
        url: _ROOT_ + "/sys/menuTree",
        lines: true,
        onSelect: function(node) {
            if (node.attributes.issort == 1) {
                $(this).tree('unSelect', node.target);
            } else {
                $grid.datagrid('load', {menu_id: node.id});
                $('#bt_function_laout_center').panel('setTitle', '<' + node.text + '> 功能列表');
                selectedMenuId = node.id;
                selectedMenuText = node.text;
            }
        }
    });
};

context.addView = function() {
    if (selectedMenuText) {
        viewDialog = $.dialog({
            title: selectedMenuText + ' 新增功能',
            href: _ROOT_ + '/sys/functionDetail',
            width: 450,
            bodyStyle: {overflow: 'hidden'},
            height: 200,
            buttons: [{
                    text: '提交',
                    handler: context.doSubmit
                }],
            onLoad: function() {
                $('#bt_function_from').find('input[name=menu_id]').val(selectedMenuId);
            }
        });
    } else {
        $.alert('请先选择对应的菜单！');
    }
};

context.updateView = function(function_id) {
    viewDialog = $.dialog({
        title: '编辑功能',
        href: _ROOT_ + '/sys/functionDetail?function_id=' + function_id,
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.doSubmit = function() {
    $bt_function_from = $('#bt_function_from');
    if ($bt_function_from.form('validate')) {
        $.post(_ROOT_ + '/sys/functionSave', $bt_function_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
    }
};

context.doDelete = function() {
    var checked = $grid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认删除？', function(r) {
            if (r) {
                var ids = [];
                $.each(checked, function() {
                    ids.push(this.function_id);
                });
                $.post(_ROOT_ + '/sys/functionDelete', {ids: ids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        $grid.datagrid('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
}; }); </script><?php }} ?>