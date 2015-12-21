<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 16:19:56
         compiled from "./Application/Home/View\Sys\function_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:264305672702cb04597-14555180%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0531543984ed202b66f48590e0ba41f1daf54461' => 
    array (
      0 => './Application/Home/View\\Sys\\function_detail.html',
      1 => 1434417015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '264305672702cb04597-14555180',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5672702cc2570',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5672702cc2570')) {function content_5672702cc2570($_smarty_tpl) {?><form id="bt_function_from" class="form">
    <table align="center">
        <tr>
            <td>名称：</td>
            <td><input name="text" class="easyui-validatebox" required="required" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['text'];?>
" style="width: 352px;"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>每个资源以分号(;)结束</td>
        </tr>
        <tr>
            <td>资源：</td>
            <td>
                <textarea class="easyui-validatebox" required="required" name="resources" style="width: 348px;resize: none;height: 60px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['resources'];?>
</textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="function_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['function_id'];?>
">
    <input type="hidden" name="menu_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['menu_id'];?>
">
</form><?php }} ?>