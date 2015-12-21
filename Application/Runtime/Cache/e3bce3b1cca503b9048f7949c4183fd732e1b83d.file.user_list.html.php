<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:48:37
         compiled from "./Application/Home/View\Sys\user_list.html" */ ?>
<?php /*%%SmartyHeaderCode:19656721475ade8d1-16109237%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3bce3b1cca503b9048f7949c4183fd732e1b83d' => 
    array (
      0 => './Application/Home/View\\Sys\\user_list.html',
      1 => 1434359246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19656721475ade8d1-16109237',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_56721475b4bf0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56721475b4bf0')) {function content_56721475b4bf0($_smarty_tpl) {?><div class="easyui-layout" fit="true">
    <div region="north" style="height: 70px;border-bottom: none;">
        <form id="bt_user_search_from">
            <table style="height: 100%;">
                <tr>
                    <td><select class="easyui-combobox" data-options="panelHeight:'auto',editable:false,onChange:function(o,n){
                                if(o == '姓名'){$('#bt_user_input_name').attr('name','Q_real_name_like')}else{
                                $('#bt_user_input_name').attr('name','Q_user_name_like')
                                }
                                }"><option>账号</option><option>姓名</option></select></td>
                    <td><input  type="text" name="Q_user_name_like" id="bt_user_input_name"></td>
                    <td>邮箱</td>
                    <td><input  type="text" name="Q_mail_like"></td>
                    <td rowspan="2"><a href="javascript:void(0)" class="easyui-linkbutton" id="bt_user_search_btn">查询</a> <a href="javascript:$('#bt_user_search_from').form('clear');" class="easyui-linkbutton">清空</a> </td>
                </tr>
                <tr>
                    <td>创建时间</td>
                    <td><input  class="easyui-my97" type="text" name="Q_create_time_EGT" maxDate="#F{ $dp.$D('bt_user_input_createTime_ed')||'2020-10-01'}" id="bt_user_input_createTime_st"></td>
                    <td align="center">-</td>
                    <td><input class="easyui-my97" type="text" name="Q_create_time_ELT" minDate="#F{ $dp.$D('bt_user_input_createTime_st')}" id="bt_user_input_createTime_ed"></td>
                </tr>
            </table>
        </form>
    </div>
    <div region="center"><table id="bt_user_grid"></table></div>
</div>
<script type="text/javascript"> NameSpace("BT.user", function() { var context = this; var $grid = $('#bt_user_grid');
var viewDialog;

context.ready = function() {
    $grid.datagrid({
        fit: true,
        border: false,
        url: _ROOT_ + '/sys/userData',
        pagination: true,
        columns: [[
                {checkbox: true},
                {field: 'user_name', title: '用户名', width: 100, align: 'center'},
                {field: 'real_name', title: '姓名', width: 100, align: 'center'},
                {field: 'mail', title: '邮箱', width: 200, align: 'center'},
                {field: 'create_time', title: '创建时间', width: 150, align: 'center', sortable: true},
                {field: 'update_time', title: '更新时间', width: 150, align: 'center', sortable: true},
                {field: 'user_id', title: '操作', width: 100, align: 'center', formatter: function(value) {
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
                var uid = $(this).attr('kid');
                context.updateView(uid);
            });
        }
    });

    $('#bt_user_search_btn').click(function() {
        $grid.datagrid('load', $('#bt_user_search_from').toJson());
    });
};

context.addView = function() {
    viewDialog = $.dialog({
        title: '新增用户',
        href: _ROOT_ + '/sys/userDetail',
        width: 450,
        height: 170,
        bodyStyle: {overflow: 'hidden'},
        buttons: [{
                text: '提交',
                handler: context.doSubmit
            }]
    });
};

context.updateView = function(uid) {
    viewDialog = $.dialog({
        title: '编辑用户',
        href: _ROOT_ + '/sys/userDetail?user_id=' + uid,
        width: 450,
        height: 170,
        bodyStyle: {overflow: 'hidden'},
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
                    ids.push(this.user_id);
                });
                $.post(_ROOT_ + '/sys/userDelete', {ids: ids.join(',')}, function(rsp) {
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

context.doSubmit = function() {
    $bt_user_from = $('#bt_user_from');
    if ($bt_user_from.form('validate')) {
        $.post(_ROOT_ + '/sys/userSave', $bt_user_from.toJson(), function(rsp) {
            if (rsp.status) {
                $grid.datagrid('reload');
                viewDialog.dialog('close');
            } else {
                $.alert(rsp.msg);
            }
        }, "JSON");
    }
}; }); </script><?php }} ?>