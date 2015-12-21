<?php /* Smarty version Smarty-3.1.6, created on 2015-12-17 09:46:16
         compiled from "./Application/Home/View\Index\login.html" */ ?>
<?php /*%%SmartyHeaderCode:25112567213e8a4d9f7-15363505%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c52e7eb90833dbb1180e704459511ff5c05d692' => 
    array (
      0 => './Application/Home/View\\Index\\login.html',
      1 => 1434589778,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25112567213e8a4d9f7-15363505',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_567213e8b8df7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567213e8b8df7')) {function content_567213e8b8df7($_smarty_tpl) {?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
    <style type="text/css">
/* start reset */
html {
	color: #333;
	background: #fff;
}

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td {
	margin: 0;
	padding: 0;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}

fieldset,img {
	border: 0;
}

address,caption,cite,code,dfn,em,th,var {
	font-style: normal;
	font-weight: normal;
}

li {
	list-style: none;
}

caption,th {
	text-align: left;
}

h1,h2,h3,h4,h5,h6 {
	font-size: 100%;
}

q:before,q:after {
	content: '';
}

abbr,acronym {
	border: 0;
	font-variant: normal;
}

sup {
	vertical-align: text-top;
}

sub {
	vertical-align: text-bottom;
}

input,textarea,select,strong {
	font-family: inherit;
	font-size: inherit;
}

input,textarea,select {
	*font-size: 100%;
}

legend {
	color: #333;
}

.clear {
	height: 0;
	font-size: 0;
	line-height: 0;
	clear: both;
}

body {
	font-size: 12px;
	background: #fff;
	font-family: tahoma, verdana, arial, helvetica, sans-serif;
	text-align: center;
	color: #333;
	background: #fff;
}

a {
	color: #333;
	text-decoration: none;
}

a:hover {
	color: #ed1c24;
}
/* end reset */
.m_login {
	width: 308px;
	height: 230px;
	margin: 0 auto;
	margin-top: 140px;
	background: url(/Public/Images/login_bg.jpg) no-repeat;
	padding: 40px 76px 0 76px;
	color: #666;
}

.login_title {
	font-size: 36px;
	margin-bottom: 20px;
	color: #000;
}

.m_login .td_name,.m_login .td_password {
	line-height: 45px;
	width: 60px;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
}

.m_login .input_login_txt {
	width: 230px;
	height: 25px;
	line-height: 25px;
	background: url(/Public/Images/login_input_l.jpg) no-repeat;
	border: 0;
	text-indent: 5px;
	font-size: 14px;
	font-weight: bold;
	color: #666;
}

.m_login .td_remember {
	
}

.m_login .td_remember {
	height: 28px;
	line-height: 28px;
}

.m_login .td_login_btn {
	height: 45px;
	line-height: 45px;
}

.m_login .login_checkbox {
	vertical-align: middle;
	margin-right: 5px;
}

.m_login .login_btn {
	width: 70px;
	height: 25px;
	background: url(/Public/Images/login_btn_l.jpg) no-repeat;
	border: 0;
	cursor: pointer;
}
</style>
    <script type="text/javascript" src="/Public/Js/core/jquery-1.8.0.min.js"></script>
    <title>System</title>
</head>
<body>
    <div class="m_login">
        <div class="login_title">
            System</div>
        <div class="m_login_form">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="td_name">
                        账号：
                    </td>
                    <td>
                        <input name="AdminId" type="text" id="userName" class="input_login_txt" maxlength="12" />
                    </td>
                </tr>
                <tr>
                    <td class="td_password">
                        密码：
                    </td>
                    <td>
                        <input name="Password" type="password" id="password" class="input_login_txt" maxlength="25" />
                    </td>
                </tr>
                <tr>
                    <td class="td_login_btn">
                        &nbsp;
                    </td>
                    <td>
                        <input type="submit" value="" class="login_btn" />
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <p style="margin-left: 25px; color: #F00;" id="msg">
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $('.login_btn').click(
				function () {
				    if ($("#userName").val().length == 0) {
				        $("#msg").empty();
				        $("#msg").append("提示：请输入用户名");
				        return false;
				    }
				    if ($("#password").val().length == 0) {
				        $("#msg").empty();
				        $("#msg").append("提示：请输入密码");
				        return false;
				    }
				    $.ajax({
				        type: "POST",
				        url: "/index/loginPost",
				        data: "user_name=" + $("#userName").val()
								+ "&password=" + $("#password").val(),
				        dataType: "JSON",
				        success: function (obj) {
				            if (!obj.status) {
				                $("#msg").empty();
				                $("#msg").append(obj.msg);
				            } else {
				                window.location.href = "/";
				            }
				        },
				        error: function (obj) {
				            $("#msg").empty();
				            $("#msg").append(obj.msg);
				        }
				    });
				})
    </script>
</body>
</html><?php }} ?>