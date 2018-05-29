<?php
/* Smarty version 3.1.29, created on 2018-04-19 13:38:08
  from "D:\php\BK\App\Back\View\Public\public.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad82b401c8d59_12578466',
  'file_dependency' => 
  array (
    'b53882dccb560ef787b9d294d9d2d2d9dbf25264' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\Public\\public.html',
      1 => 1523352574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad82b401c8d59_12578466 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>个人空间后台管理系统</title>
    <link rel="icon" href="<?php echo @constant('SITE_URL');?>
/Public/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo @constant('CSS_DIR');?>
/pintuer.css">
    <link rel="stylesheet" href="<?php echo @constant('CSS_DIR');?>
/admin.css">
    <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/pintuer.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/respond.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/admin.js"><?php echo '</script'; ?>
>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link href="/favicon.ico" rel="bookmark icon" />
</head> 
<body>  
<div class="lefter">
    <div class="logo"><a href="#" target="_blank"><img src="<?php echo @constant('IMAGES_DIR');?>
/logo.png" class="radius" alt="后台管理系统" /></a></div>
</div>
<!--start-->
<?php echo '<script'; ?>
 type="text/javascript" src="http://www.daixiaorui.com/Public/js/jquery.min.js"><?php echo '</script'; ?>
>
<style type="text/css">
    .menu li a { display:block; width:100px; text-align:center; height:36px; line-height:36px; }
    /*子集样式*/
    .cur{ font-weight:bold; }
    .curument { background:#ADFF2F; width:100%px;}
    /*父级样式*/
    .par{ background-color:#ADFF2F; font-weight:bold; font-size:16px; }
    
</style>
<?php echo '<script'; ?>
 language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
<?php echo '</script'; ?>
>
<!-- <ul class="nav nav-inline admin-nav"> -->
<div class="righter nav-navicon" id="admin-nav">
    <div class="mainer">
        <div class="admin-navbar">
            <span class="float-right">
            	<a class="button button-little bg-main" href="/" target="_blank">前台首页</a>
                <a class="button button-little bg-yellow" href="index.php?p=Back&c=Admin&a=logout">注销登录</a>
				<input type="button" value="返回" onclick="fun()" class="button button-little bg-red">
            </span>
            <ul class="menu admin-nav" id="menu">
                <li class="active"><a href="index.php?p=Back&c=Manage&a=index" > 开始</a>
            <ul>
<div style="width:200px; height:500px;overflow:scroll" id="menuchild">
<?php
$_from = $_smarty_tpl->tpl_vars['auth_infoA']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_v_0_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$__foreach_v_0_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$__foreach_v_0_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
<table cellspacing='0' cellpadding='0' width='150' border='1'>
    <tr height=22>
        <td style="padding-left: 30px" id="menuparent">
            <a  onclick="expand(<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
)" href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_name'];?>
</a>
        </td>
    </tr>
    <tr height=4><td></td></tr>
</table>
<table id="child<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
" style="display: none" cellspacing=0 cellpadding=0 
       width=150 border=1>
    <?php
$_from = $_smarty_tpl->tpl_vars['auth_infoB']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_1_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$__foreach_vv_1_saved_key = isset($_smarty_tpl->tpl_vars['kk']) ? $_smarty_tpl->tpl_vars['kk'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['vv']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
$_smarty_tpl->tpl_vars['vv']->_loop = true;
$__foreach_vv_1_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>

    <?php if ($_smarty_tpl->tpl_vars['vv']->value['auth_pid'] === $_smarty_tpl->tpl_vars['v']->value['auth_id']) {?>
    <tr height=20>
            <!--格式 p=Back&c=Category&a=index -->
        <td width=150 align="center"><li class="curument"><a href="<?php echo @constant('SITE_URL');?>
/index.php?p=Back&c=<?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_c'];?>
&a=<?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_a'];?>
"  target="_self"><?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_name'];?>
</a>
        </li>
        </td>
    </tr>
    <?php }?>
    <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_local_item;
}
if ($__foreach_vv_1_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_item;
}
if ($__foreach_vv_1_saved_key) {
$_smarty_tpl->tpl_vars['kk'] = $__foreach_vv_1_saved_key;
}
?>
</table>
<?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_local_item;
}
if ($__foreach_v_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_item;
}
if ($__foreach_v_0_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_v_0_saved_key;
}
?>
</div>
                        <!-- <li><a href="index.php?p=Back&c=Category&a=index" >分类管理</a></li>
					    <li><a href="index.php?p=Back&c=Article&a=index" >文章管理</a></li>
						<li><a href="index.php?p=Back&c=Comment&a=index" >评论管理</a></li><li><a href="index.php?p=Back&c=SinglePage&a=index" >单页管理</a></li>
						<li><a href="index.php?p=Back&c=Master&a=index" >站长管理</a></li>
						<li><a href="index.php?p=Back&c=Friendship&a=index" >友情链接</a></li>
						<li><a href="index.php?p=Back&c=User&a=index" >用户管理</a></li>
                        <li><a href="index.php?p=Back&c=Banner&a=index" >Banner管理</a></li>
                        <li><a href="index.php?p=Back&c=AuthManager&a=index" >权限管理</a></li> -->
					</ul>
                </li>
            </ul>
        </div>

<!--start-->
<?php echo '<script'; ?>
 type="text/javascript">
  var urlstr = location.href;
  var urlstatus=false;
  $("#menu a").each(function () {
    if ((urlstr + '/').indexOf($(this).attr('href')) > -1&&$(this).attr('href')!='') {
      $(this).addClass('cur'); urlstatus = true;
    } else {
       $(this).removeClass('cur');
    }
  });
  if (!urlstatus) { $("#menu a").eq(0).addClass('cur'); }
<?php echo '</script'; ?>
>
<!--end-->

        <div class="admin-bread">
            <span>您好，<?php echo $_SESSION['adminInfo']['admin_name'];?>
，欢迎您的光临。</span>
            <ul class="bread">
                <li><a href="index.php?p=Back&c=Manage&a=index" class="icon-home"> 开始</a></li>
                <li>后台首页</li>
            </ul>
        </div>
    </div>
</div>
<?php }
}
