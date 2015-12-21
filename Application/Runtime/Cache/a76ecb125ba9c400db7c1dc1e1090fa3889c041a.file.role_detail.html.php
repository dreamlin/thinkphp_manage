<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 10:00:40
         compiled from "./Application/Home/View\Sys\role_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1944956721748e384d9-79215317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a76ecb125ba9c400db7c1dc1e1090fa3889c041a' => 
    array (
      0 => './Application/Home/View\\Sys\\role_detail.html',
      1 => 1434421046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1944956721748e384d9-79215317',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_56721748e8a59',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56721748e8a59')) {function content_56721748e8a59($_smarty_tpl) {?><form id="bt_role_from" class="form">
    <table align="center">
        <tr>
            <td>名称：</td>
            <td><input name="text" class="easyui-validatebox" required="required" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['text'];?>
" style="width: 352px;"/></td>
        </tr>
        <tr>
            <td>状态：</td>
            <td><input name="status" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==0){?> checked="checked" <?php }?> value="0"/>可用 <input name="status" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> checked="checked" <?php }?> value="1"/>禁用 </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td>
                <textarea name="remark" style="width: 348px;resize: none;height: 60px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['remark'];?>
</textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="role_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['role_id'];?>
">
</form><?php }} ?>