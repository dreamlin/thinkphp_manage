<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:50:27
         compiled from "./Application/Home/View\Sys\org_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:21315567214e37293c3-83658442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87ea419cc7fd606814bf67e2dd5db453670d2bf9' => 
    array (
      0 => './Application/Home/View\\Sys\\org_detail.html',
      1 => 1434523007,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21315567214e37293c3-83658442',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_567214e378ece',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567214e378ece')) {function content_567214e378ece($_smarty_tpl) {?><form id="bt_org_from" class="form">
    <table align="center">
        <tr>
            <td>父项：</td>
            <td valign="middle"><input id="bt_org_comboTree"  name='pid' class="easyui-combotree" style="width:130px;" data-options="url:'/sys/orgComboData?org_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['org_id'];?>
',valueField:'org_id',textField:'title'" value="<?php if ($_smarty_tpl->tpl_vars['data']->value['pid']){?><?php echo $_smarty_tpl->tpl_vars['data']->value['pid'];?>
<?php }else{ ?>0<?php }?>"> <img src="/Public/Images/clear.png" onclick="$('#bt_org_comboTree').combotree('clear');" style="cursor: pointer;vertical-align:middle;"></td>
            <td>名称：</td>
            <td><input name="title" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" class="easyui-validatebox" required="required"/></td>
        </tr>
        <tr>
            <td>主管：</td>
            <td><select id="bt_org_combogrid" class="easyui-combogrid" name="org_manager" style="width:130px;"  
                        data-options="  
                        panelWidth:420,
                        pagination:true,
                        multiple:true,
                        editable:false,
                        idField:'user_id',
                        value:[<?php echo $_smarty_tpl->tpl_vars['data']->value['org_manager'];?>
],
                        textField:'real_name',  
                        url:'/sys/userData',  
                        columns:[[  
                        {field:'real_name',title:'姓名',width:100},  
                        {field:'user_name',title:'账号',width:100},
                        {field:'mail',title:'邮箱',width:120}
                        ]]  
                        "></select> <img src="/Public/Images/clear.png" onclick="$('#bt_org_combogrid').combogrid('clear');" style="cursor: pointer;vertical-align:middle;">
            </td>
            <td>排序：</td>
            <td><input name="seq" type="text" class="easyui-numberbox" value="<?php if ($_smarty_tpl->tpl_vars['data']->value['seq']){?><?php echo $_smarty_tpl->tpl_vars['data']->value['seq'];?>
<?php }else{ ?>0<?php }?>" data-options="min:0,precision:0"/></td>
        </tr>
        <tr>
            <td>描述：</td>
            <td colspan="3"><textarea name="description" style="width: 345px;resize: none;height: 50px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</textarea></td>
        </tr>
    </table>
    <input type="hidden" name="org_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['org_id'];?>
">
</form><?php }} ?>