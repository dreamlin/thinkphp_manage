<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:50:53
         compiled from "./Application/Home/View\Sys\menu_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:17681567214fd2f1705-86571335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a11daa1c2405559bd7a17786c372615266e4a04' => 
    array (
      0 => './Application/Home/View\\Sys\\menu_detail.html',
      1 => 1434330808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17681567214fd2f1705-86571335',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_567214fd35aeb',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567214fd35aeb')) {function content_567214fd35aeb($_smarty_tpl) {?><form id="bt_menu_from" class="form">
    <table align="center">
        <tr>
            <td>父项：</td>
            <td valign="middle"><input id="bt_menu_comboTree"  name='pid' class="easyui-combotree" style="width:130px;" data-options="url:'/sys/menuDataSort',valueField:'mid'" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['pid'];?>
"> <img src="/Public/Images/clear.png" onclick="$('#bt_menu_comboTree').combotree('clear');" style="cursor: pointer;vertical-align:middle;"></td>
            <td>名称：</td>
            <td><input name="text" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['text'];?>
" class="easyui-validatebox" required="required"/></td>
        </tr>
        <tr>
            <td>链接：</td>
            <td colspan="3"><input name="href" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['href'];?>
" style="width: 352px;"/></td>
        </tr>
        <tr>
            <td>图标：</td>
            <td><input name="icon_cls" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['icon_cls'];?>
"/></td>
            <td>排序：</td>
            <td><input name="seq" type="text" class="easyui-numberbox" value="<?php if ($_smarty_tpl->tpl_vars['data']->value['seq']){?><?php echo $_smarty_tpl->tpl_vars['data']->value['seq'];?>
<?php }else{ ?>0<?php }?>" data-options="min:0,precision:0"/></td>
        </tr>
        <tr>
            <td>状态：</td>                           
            <td><input name="status" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==0){?> checked="checked" <?php }?> value="0"/>可用 <input name="status" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> checked="checked" <?php }?> value="1"/>禁用 </td>
            <td>分类：</td>
            <td><input name="is_sort" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['is_sort']==0){?> checked="checked" <?php }?> value="0"/>否 <input name="is_sort" type="radio" <?php if ($_smarty_tpl->tpl_vars['data']->value['is_sort']==1){?> checked="checked" <?php }?> value="1"/>是 </td>
        </tr>
    </table>
    <input type="hidden" name="menu_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['menu_id'];?>
">
</form><?php }} ?>