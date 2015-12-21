<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:48:25
         compiled from "./Application/Home/View\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1752156721469eae6e5-25137729%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8378b70862d866fede2c1372bd9cfe4821690da8' => 
    array (
      0 => './Application/Home/View\\Index\\index.html',
      1 => 1434612390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1752156721469eae6e5-25137729',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menuData' => 0,
    'isLock' => 0,
    'realName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_56721469f0c31',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56721469f0c31')) {function content_56721469f0c31($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title>管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" id="bt_index_theme_link" href="/Public/Themes/bootstrap/easyui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/Public/Themes/icon.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/Public/Css/css.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/Public/Js/core/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="/Public/Js/core/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="/Public/Js/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="/Public/Js/core/btutil.js"></script>
        <script type="text/javascript" src="/Public/Js/My97DatePicker/WdatePicker.js"></script>
        <script>
            var _ROOT_ = '';
            var _THEME_PATH_ = '/Public/Themes';
            var _MENUDATA_ = <?php echo $_smarty_tpl->tpl_vars['menuData']->value;?>
;
            var _OPTIONS = {"themeName":"bootstrap"};
        </script>
        <script type="text/javascript" src="/Public/Js/common/global.js"></script>
    </head>
    <body class="easyui-layout" <?php if ($_smarty_tpl->tpl_vars['isLock']->value){?>onload="_systemLock()"<?php }?>>
        <div data-options="region:'north',border:false" style="height: 60px;overflow: hidden;">
            <h1 style="position: absolute;">管理系统</h1>
            <div class="user_info">【<?php echo $_smarty_tpl->tpl_vars['realName']->value;?>
】,欢迎您。</div>
            <div class="system_controller"><a href="javascript:void(0)" class="easyui-menubutton" data-options="menu:'#bt_index_zxMenu',iconCls:'icon-controller'">控制面板</a></div>
        </div>
        <div data-options="region:'west'" style="width: 200px;border-right: none;border-bottom: none;" title="导航">
            <ul id="bt_index_menu_tree"></ul>
        </div>
        <div id="bt_index_layout_center" data-options="region:'center',href:'/index/welcome'" style="border-bottom: none;border-top: none;padding: 5px;" title="欢迎">

        </div>
        <div data-options="region:'south'" style="height: 25px;text-align: center;line-height: 25px;overflow: hidden;">
            版权所有
            <form id="bt_jump_form" method="post" style="display: none;" target="_blank"><input name="title" id="bt_jump_page_title"/></form>
        </div>
        <div id="bt_loading" class="loading"></div>
        <div id="bt_loading_progress" class="progress">执行中...</div>

        <div id="bt_index_zxMenu" style="display: none;">  
            <div data-options="iconCls:'icon-setting'">个人设置</div>
            <div data-options="iconCls:'icon-theme'">
                <span>主题切换</span>
                <div style="width:100px;">  
                    <div class="theme" name="default">default</div>  
                    <div class="theme" name="bootstrap">bootstrap</div>  
                    <div class="theme" name="black">black</div>  
                    <div class="theme" name="gray">gray</div>
                    <div class="theme" name="metro">metro</div>
                </div> 
            </div>
            <div class="menu-sep"></div> 
            <div data-options="iconCls:'icon-lock'" id="bt_index_control_menu_lock">锁定系统</div>
            <div data-options="iconCls:'icon-exit',href:'/index/logout'">退出系统</div>
        </div>
    </body>
</html><?php }} ?>