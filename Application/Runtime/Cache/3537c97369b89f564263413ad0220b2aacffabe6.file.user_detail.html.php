<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:50:35
         compiled from "./Application/Home/View\Sys\user_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:16982567214eb0003d3-64683906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3537c97369b89f564263413ad0220b2aacffabe6' => 
    array (
      0 => './Application/Home/View\\Sys\\user_detail.html',
      1 => 1434508779,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16982567214eb0003d3-64683906',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'roles' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_567214eb05a17',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567214eb05a17')) {function content_567214eb05a17($_smarty_tpl) {?><form id="bt_user_from" class="form">
    <table align="center">
        <tr>
            <td>账号：</td>
            <td><input name="user_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['user_name'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['user_name']){?> readonly="readonly" <?php }?> class="easyui-validatebox" required="required" maxlength="20"/></td>
            <td>姓名：</td>
            <td><input name="real_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['real_name'];?>
" class="easyui-validatebox" required="required"  maxlength="16"/></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input name="password" type="password" maxlength="16" <?php if (!$_smarty_tpl->tpl_vars['data']->value['user_id']){?> class="easyui-validatebox" <?php }?> required="required"/></td>
            <td>邮箱：</td>
            <td><input name="mail" type="text" class="easyui-validatebox" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['mail'];?>
" data-options="validType: 'email'" required="required" maxlength="30"/></td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['data']->value['user_id']){?>
        <tr>
            <td>角色：</td>
            <td valign="middle" colspan="3"><input id="bt_user_roles_combo"  name='role_ids' class="easyui-combobox" style="width:330px;" data-options='data:<?php echo $_smarty_tpl->tpl_vars['roles']->value;?>
,valueField:"role_id",multiple:true,value:[<?php echo $_smarty_tpl->tpl_vars['data']->value['role_ids'];?>
]'> <img src="/Public/Images/clear.png" onclick="$('#bt_user_roles_combo').combobox('clear');" style="cursor: pointer;vertical-align:middle;"></td>
        </tr>
        <?php }?>
    </table>
    <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['user_id'];?>
">
</form><?php }} ?>