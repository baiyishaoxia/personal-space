<?php
/* Smarty version 3.1.29, created on 2018-03-29 23:25:03
  from "/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/header.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abd054fc9c850_27890432',
  'file_dependency' => 
  array (
    '90bd1400aca08683d1b51d7348d2ecd6cfd4fd21' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/header.html',
      1 => 1522336816,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abd054fc9c850_27890432 ($_smarty_tpl) {
?>
<style type="text/css">
.keyword{
    margin-left:200px; 
}
.submit{
    margin-left: 12px;
}
</style>
  <header>
    <h1>蜗牛的家<font size="2px" style="margin-left: 20px">“给我一个小小的家，蜗牛的家，能挡风遮雨的地方，不必太大...”</font>
    </h1>
    <h2 style="background:gray; color:white; border-radius: 5px;width: 55%;">
    <marquee direction='left' id='m' onmouseout=m.start() onMouseOver=m.stop() scrollamount='6' loop="-1">
    公告：欢迎您的光临，本站所发布之文章皆为作者亲测通过，如有错误，欢迎通过各种方式指正。
    (本站已于2018.3.20升级到php7,运行环境php7 + mysql5.7.14 + Apache2.4.23)
    </marquee>
    </h2>  
      <div align="center">
      <form action="index.php?p=Home&c=Article&a=search" method="POST">
                    <input class="keyword" type="text" name="keyword" placeholder="搜索其实很简单" style="text-align:center;margin-left:-175px;width:210px;height:20px;background-color:transparent"/>
                    <input class="submit" type="submit" value="整站搜索" style="border:1px #0A0A0A solid;font-size: 12px;background-color:#FFFFFF;border-radius:8px;margin-right:-180px;" />
      </form>
      </div>
    <div class="logo"><a href="/"></a></div>
    <nav id="topnav"><a href="/">首页</a>
    <?php
$_from = $_smarty_tpl->tpl_vars['firstCate']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
    <a href="index.php?p=Home&c=Article&a=index&cate_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
#tipsArticle<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_name'];?>
</a>
    <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
    <a href="index.php?p=Home&c=SinglePage&a=index&page_id=1">关于我</a>
    <?php if ((($tmp = @$_SESSION['user_info']['user_id'])===null||$tmp==='' ? 0 : $tmp) > 0) {?>
    <a style="font-size:12px;padding:0" href="index.php?p=Home&c=Index&a=index">欢迎您,<?php echo $_SESSION['user_info']['user_name'];?>
&nbsp;</a>
	<a style="font-size:12px;padding:0" href="index.php?p=Home&c=User&a=headimage">更换头像</a>
    <a style="font-size:12px;padding:0" href="index.php?p=Home&c=User&a=logout">退出</a>
    <?php } else { ?>
    <a style="font-size:12px;padding:0" href="index.php?p=Home&c=User&a=login#tipslogin">登录&nbsp;</a>
    <a style="font-size:12px;padding:0" href="index.php?p=Home&c=User&a=register#tipsregister">注册</a>
    <?php }?>
    </nav>
  </header><?php }
}
