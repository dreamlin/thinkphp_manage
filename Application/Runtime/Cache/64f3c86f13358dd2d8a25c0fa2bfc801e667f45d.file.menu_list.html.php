<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:48:29
         compiled from "./Application/Home/View\Sys\menu_list.html" */ ?>
<?php /*%%SmartyHeaderCode:240505672146d58bea6-27836381%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64f3c86f13358dd2d8a25c0fa2bfc801e667f45d' => 
    array (
      0 => './Application/Home/View\\Sys\\menu_list.html',
      1 => 1434527563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '240505672146d58bea6-27836381',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5672146d69979',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5672146d69979')) {function content_5672146d69979($_smarty_tpl) {?><table id="bt_menu"></table>
<script type="text/javascript"> NameSpace("BT.menu", function() { var context = this; var $grid = $('#bt_menu');
context.ready = function() {
    $grid.treegrid({
        fit: true,
        url: _ROOT_ + '/sys/menuData',
        idField: 'menu_id',
        treeField: 'text',
        columns: [[
                {field: 'text', title: '名称', width: 200},
                {field: 'href', title: '链接', width: 200},
                {field: 'status', title: '状态', width: 100, align: 'center', formatter: function(value) {
                        if (value === '0') {
                            return '可用';
                        }
                        return '<font color="red">禁用</font>';
                    }},
                {field: 'seq', title: '序号', width: 50, align: 'center'},
                {field: 'menu_id', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        var ctrs = ['<span  title="编辑" class="img-btn icon-edit" type="update" menu_id=' + value + '></span>', '<span title="删除" class="img-btn icon-remove" type="delete" menu_id=' + value + '></span>'];
                        return ctrs.join(' ');
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: context.addView
            }, '-', {
                text: '字典类型管理',
                iconCls: 'icon-category',
                handler: typeView
            }],
        onLoadSuccess: function() {
            var $bodyView = $grid.data('datagrid').dc.view2;
            $bodyView.find('span[menu_id]').click(function(e) {
                var type = $(this).attr('type');
                var menu_id = $(this).attr('menu_id');
                var data = $grid.treegrid('find', menu_id);
                if (type === 'update') {
                    context.updateView(menu_id);
                } else {
                    context.deleted(menu_id);
                }
                e.stopPropagation();
            });
        }
    });
};
var viewDialog;
context.addView = function() {
    viewDialog = $.dialog({
        title: '新增菜单',
        href: _ROOT_ + '/sys/menuDetail',
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doAdd
            }]
    });
};

context.deleted = function(menu_id) {
    $.messager.confirm('提示', '确认删除？', function(r) {
        if (r) {
            $.post(_ROOT_ + '/sys/menuDelete', {menu_id: menu_id}, function(rsp) {
                if (rsp.status) {
                    $grid.treegrid('remove', menu_id);
                } else {
                    $.alert(rsp.msg);
                }
            });
        }
    });
};

context.doAdd = function() {
    $bt_menu_from = $('#bt_menu_from');
    if ($bt_menu_from.form('validate')) {
        $.post(_ROOT_ + '/sys/menuSave', $bt_menu_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.treegrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        });
    }
};

context.updateView = function(menu_id) {
    viewDialog = $.dialog({
        title: '更新菜单',
        href: _ROOT_ + '/sys/menuDetail?menu_id=' + menu_id,
        width: 430,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doAdd
            }]
    });
};

var typeView = function() {
    viewDialog = $.dialog({
        title: '字典类型管理',
        href: _ROOT_ + '/sys/dictWindow',
        width: 350,
        bodyStyle: {overflow: 'hidden'},
        height: 400,
        onLoad: typeViewOnLoad,
        onBeforeClose: function() {
            var rows = $typeGrid.datagrid('getEditing');
            for (var i = 0; i < rows.length; i++) {
                $typeGrid.datagrid('endEdit', rows[i]);
            }
            rows = $typeGrid.datagrid('getEditing');
            if (rows.length === 0 && $typeGrid.datagrid('getChanges').length) {
                $.confirm("记录已经发生变更,是否提交变更记录?", function(r) {
                    if (r) {
                        doTypeSave();
                    } else {
                        viewDialog.close();
                    }
                });
                return false;
            }
        }
    });
};
var typeViewOnLoad = function() {
    $typeGrid = $('#bt_dict_type_grid');
    $typeGrid.datagrid({
        fit: true,
        border: false,
        fitColumns: true,
        url: _ROOT_ + '/sys/dictData',
        columns: [[
                {checkbox: true, field: 'dict_id'},
                {field: 'dict_key', title: 'Key', width: 100, align: 'center', editor: {type: 'validatebox', options: {invalidMessage: '该标识已经存在！', required: true,validType: 'remote["' + _ROOT_ + '/sys/validDictKey","dict_key"]'}}},
                {field: 'dict_value', title: 'Value', width: 100, align: 'center', editor: {type: 'validatebox', options: {required: true}}},
                {field: 'status', title: '状态', width: 70, align: 'center', formatter: function(value) {
                        if (!value) {
                            return '';
                        }
                        if (value === '0') {
                            return '使用中';
                        }
                        return '<font color="red">已删除</font>';
                    }}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: toTypeAdd
            }, {
                text: '删除',
                iconCls: 'icon-remove',
                handler: doTypeDelete
            }, '-', {
                text: '保存',
                iconCls: 'icon-save',
                handler: doTypeSave
            }],
        onDblClickRow: function(rowIndex, rowData) {
            if (rowData.status === "0") {
                $typeGrid.datagrid('beginEdit', rowIndex);
                var ed = $typeGrid.datagrid('getEditor', {index: rowIndex, field: 'dict_key'});
                $(ed.target).validatebox({validType: 'remote["' + _ROOT_ + '/sys/validDictKey?id=' + rowData.dict_id + '","dict_key"]'}).focus();
            }
        },
        onSelect: function(rowIndex, rowData) {
            if (rowData.status !== "0") {
                $(this).datagrid("unselectRow", rowIndex);
            }
        }
    });
};
var toTypeAdd = function() {
    $typeGrid.datagrid('insertRow', {index: 0, row: {}});
    $typeGrid.datagrid('beginEdit', 0);
    var ed = $typeGrid.datagrid('getEditor', {index: 0, field: 'dict_key'});
    $(ed.target).validatebox({}).focus();
};
var doTypeDelete = function() {
    var rows = $typeGrid.datagrid('getChecked');
    $.each(rows, function() {
        var index = $typeGrid.datagrid('getRowIndex', this);
        $typeGrid.datagrid('deleteRow', index);
    });
};
var doTypeSave = function() {
    var rows = $typeGrid.datagrid('getEditing');
    for (var i = 0; i < rows.length; i++) {
        $typeGrid.datagrid('endEdit', rows[i]);
    }
    rows = $typeGrid.datagrid('getEditing');
    if (rows.length === 0 && $typeGrid.datagrid('getChanges').length) {
        var inserted = $typeGrid.datagrid('getChanges', "inserted");
        var updated = $typeGrid.datagrid('getChanges', "updated");
        var deleted = $typeGrid.datagrid('getChanges', "deleted");
        var effectRow = new Object();
        if (inserted.length) {
            effectRow["inserted"] = JSON.stringify(inserted);
        }
        if (deleted.length) {
            effectRow["deleted"] = JSON.stringify(deleted);
        }
        if (updated.length) {
            effectRow["updated"] = JSON.stringify(updated);
        }

        $.post(_ROOT_ + '/sys/dictSave', effectRow, function(rsp) {
            if (rsp.status) {
                $.alert("保存成功！");
                $typeGrid.datagrid('acceptChanges');
                $typeGrid.datagrid('reload');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
    }
};

 }); </script><?php }} ?>