<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:48:41
         compiled from "./Application/Home/View\Sys\role_list.html" */ ?>
<?php /*%%SmartyHeaderCode:152775672147904cd04-98974994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0e44e269c0efe19edf4c7618a171fa9b2c19fba' => 
    array (
      0 => './Application/Home/View\\Sys\\role_list.html',
      1 => 1434441761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152775672147904cd04-98974994',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5672147910855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5672147910855')) {function content_5672147910855($_smarty_tpl) {?><div class="easyui-layout" fit="true" id='bt_role_layout'>
    <div region="center" style="border-bottom: none;">
        <table id="bt_role_grid"></table>
    </div>
    <div region="south" style="height: 250px;padding: 2px;" title="角色详情" collapsed="true" split='true'>
        <div class="easyui-layout" fit="true">
            <div region="center" title="成员" style="border-left: none;">
                <table id="bt_role_user_grid"></table>
            </div>
            <div region="west" style="width: 400px;">
                <div class="easyui-panel" fit="true" border="false" title="权限">
                        <table id="bt_role_right_grid"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> NameSpace("BT.role", function() { var context = this; var $grid = $('#bt_role_grid'), $rigthGrid = $('#bt_role_right_grid'), $userGrid = $('#bt_role_user_grid');
var viewDialog, role_id, grantTree, $chooseuserGrid;

context.ready = function() {
    $grid.datagrid({
        fit: true,
        border: false,
        url: _ROOT_ + '/sys/roleData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'text', title: '名称', width: 150, align: 'center'},
                {field: 'remark', title: '备注', width: 200},
                {field: 'status', title: '状态', width: 100, align: 'center', formatter: function(value) {
                        if (value === '0') {
                            return '可用';
                        }
                        return '<font color="red">禁用</font>';
                    }},
                {field: 'role_id', title: '操作', width: 100, align: 'center', formatter: function(value) {
                        return '<span title="编辑" class="img-btn icon-edit" kid=' + value + '></span>';
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
            $bodyView.find('span[kid]').click(function(e) {
                e.stopPropagation();
                var id = $(this).attr('kid');
                context.updateView(id);
            });
        },
        onClickRow: function(rowIndex, rowData) {
            if (role_id && role_id === rowData.role_id) {
                return;
            }
            var $layout = $('#bt_role_layout');
            var south = $layout.layout('panel', 'south');
            if (south.panel('options').collapsed) {
                $layout.layout('expand', 'south');
            }

            role_id = rowData.role_id;
            grantTree.tree({
                url: _ROOT_ + '/sys/roleFunctionData?role_id=' + role_id,
                checkbox: true,
                lines: true
            });

            $userGrid.datagrid({
                url: _ROOT_ + '/sys/roleUserData',
                queryParams: {role_id: role_id}
            });
        }
    });

    $rigthGrid.datagrid({
        fit: true,
        border: false,
        showHeader: false,
        toolbar: [{
                text: '授权',
                iconCls: 'icon-add',
                handler: context.toGrant
            }, {
                text: '解除',
                iconCls: 'icon-remove',
                handler: context.unGrant
            }]
    });
    grantTree = $('<ul/>');
    $('#bt_role_right_grid').data().datagrid.dc.body2.append(grantTree);

    $userGrid.datagrid({
        fit: true,
        border: false,
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'user_name', title: '账号', width: 150},
                {field: 'real_name', title: '姓名', width: 150},
                {field: 'mail', title: '邮箱', width: 150}
            ]],
        toolbar: [{
                text: '新增',
                iconCls: 'icon-add',
                handler: context.addRoleUserView
            }, {
                text: '删除',
                iconCls: 'icon-remove',
                handler: context.doDeleteUser
            }]
    });
};

context.addView = function() {
    viewDialog = $.dialog({
        title: '新增角色',
        href: _ROOT_ + '/sys/roleDetail',
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.addRoleUserView = function() {
    viewDialog = $.dialog({
        title: '角色添加用户',
        href: _ROOT_ + '/sys/chooseUser',
        width: 550,
        bodyStyle: {overflow: 'hidden'},
        height: 300,
        buttons: [{
                text: '确认添加',
                handler: context.doAddUserSubmit
            }],
        onLoad: function() {
           setTimeout(function() {
                $chooseuserGrid = BT.common.chooseuser.chooseuserGrid;
                $chooseuserGrid.datagrid({url: _ROOT_ + '/sys/chooseUserData?role_id=' + role_id});
            }, 100);
        }
    });
};

context.doSubmit = function() {
    $bt_role_from = $('#bt_role_from');
    if ($bt_role_from.form('validate')) {
        $.post(_ROOT_ + '/sys/roleSave', $bt_role_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
    }
};

context.doAddUserSubmit = function() {
    var checked = $chooseuserGrid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        var ids = [];
        $.each(checked, function() {
            ids.push(this.user_id);
        });
        $.post(_ROOT_ + '/sys/chooseUserSave', {role_id: role_id, uids: ids.join(',')}, function(rsp) {
            if (rsp.status) {
                $userGrid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, 'JSON');
    } else {
        $.alert('没有选择任何用户！');
    }
};

context.updateView = function(id) {
    viewDialog = $.dialog({
        title: '编辑角色',
        href: _ROOT_ + '/sys/roleDetail?role_id=' + id,
        width: 450,
        bodyStyle: {overflow: 'hidden'},
        height: 200,
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.doDelete = function() {
    var checked = $grid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认删除？', function(r) {
            if (r) {
                var ids = [];
                $.each(checked, function() {
                    ids.push(this.role_id);
                });
                $.post(_ROOT_ + '/sys/roleDelete', {ids: ids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        $grid.datagrid('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
};

context.doDeleteUser = function() {
    var checked = $userGrid.datagrid('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认删除？', function(r) {
            if (r) {
                var ids = [];
                $.each(checked, function() {
                    ids.push(this.user_id);
                });
                $.post(_ROOT_ + '/sys/roleUserDelete', {role_id: role_id, ids: ids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        $userGrid.datagrid('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
};

context.toGrant = function() {
    if (role_id) {
        viewDialog = $.dialog({
            title: '授权',
            href: _ROOT_ + '/sys/roleGrantTree?role_id=' + role_id,
            width: 350,
            height: 400,
            buttons: [{
                    text: '确认',
                    handler: context.doGrant
                }]
        });
    }
};

context.doGrant = function() {
    $tree = $('#bt_role_right_tree');
    var checked = $tree.tree('getChecked');
    var indeterminate = $tree.tree('getChecked', 'indeterminate');
    var checkData = $.merge(checked, indeterminate);
    var gids = [];
    $.each(checkData, function() {
        if (this.id) {
            gids.push(this.id);
        }
    });
    $.post(_ROOT_ + '/sys/roleGrant', {role_id: role_id, gids: gids.join(',')}, function(rsp) {
        if (rsp.status) {
            grantTree.tree('reload');
            viewDialog.dialog('close');
        } else {
            $.alert(rsp.msg);
        }
    }, 'JSON');
};

context.unGrant = function() {
    var checked = grantTree.tree('getChecked');
    if (checked && checked.length > 0) {
        $.confirm('确认要解除这组授权？', function(r) {
            if (r) {
                var tids = [];
                $.each(checked, function() {
                    tids.push(this.id);
                });

                $.post(_ROOT_ + '/sys/roleUnGrant', {tids: tids.join(',')}, function(rsp) {
                    if (rsp.status) {
                        grantTree.tree('reload');
                    } else {
                        $.alert(rsp.msg);
                    }
                }, 'JSON');
            }
        });
    }
}; }); </script><?php }} ?>