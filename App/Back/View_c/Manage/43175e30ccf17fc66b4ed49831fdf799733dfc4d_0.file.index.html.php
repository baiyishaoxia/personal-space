<?php
/* Smarty version 3.1.29, created on 2018-03-31 07:11:51
  from "/www/tzf.afu666.xyz/App/Back/View/Manage/index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abf34b7acbe64_76467235',
  'file_dependency' => 
  array (
    '43175e30ccf17fc66b4ed49831fdf799733dfc4d' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Back/View/Manage/index.html',
      1 => 1521880608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abf34b7acbe64_76467235 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/www/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.date_format.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin">
	<div class="line-big">
    	<div class="xm3">
        	<div class="panel border-back">
            	<div class="panel-body text-center">
                	<img src="<?php echo @constant('IMAGES_DIR');?>
/face.jpg" width="120" class="radius-circle" /><br />
                    <?php echo $_SESSION['adminInfo']['admin_name'];?>
<br />
                    上线时间:<?php echo smarty_modifier_date_format((time()+28800),'%Y-%m-%d %H:%M:%S');?>

                </div>
                <div class="panel-foot bg-back border-back">您好，<?php echo $_SESSION['adminInfo']['admin_name'];?>
，这是您第<?php echo $_SESSION['adminInfo']['login_nums']+1;?>
次登录，上次登录时间为<?php echo smarty_modifier_date_format(($_SESSION['adminInfo']['login_time']+28800),'%Y-%m-%d %T');?>
，上次登录的IP为<?php echo $_SESSION['adminInfo']['login_ip'];?>
</div>
            </div>
            <br />
        	<div class="panel">
            	<div class="panel-head"><strong>站点统计</strong></div>
                <ul class="list-group">
                	<li><span class="float-right badge bg-red"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</span><span class="icon-user"></span> <a href="index.php?p=Back&c=User&a=index">会员</a></li>
                    <li><span class="float-right badge bg-main"><?php echo $_smarty_tpl->tpl_vars['article']->value;?>
</span><span class="icon-file"></span> <a href="index.php?p=Back&c=Article&a=index">文章</a></li>
                    <li><span class="float-right badge bg-main">1</span><span class="icon-database"></span> 数据库</li>
                </ul>
            </div>
            <br />
        </div>
        <div class="xm9">
            <div class="alert">
                <div class="alert alert-yellow"><span class="close"></span><strong>提示：</strong>欢迎使用作者开发的基于MVC纯框架！</div>
                <h4>基于MVC框架的Space介绍</h4>
                <p class="text-gray padding-top">该空间系统基于MVC框架，高效、简洁……</p>
            	<a target="_blank" class="button bg-dot icon-code" href="#"> 下载示例代码</a> 
            	<a target="_blank" class="button bg-main icon-download" href="#"> 下载MVC框架</a> 
            	<a target="_blank" class="button border-main icon-file" href="#"> MVC框架使用教程</a>
            </div>
            <div class="panel">
            	<div class="panel-head"><strong>系统信息</strong></div>
                <table class="table">
                	<tr><th colspan="2">服务器信息</th><th colspan="2">系统信息</th></tr>
                    <tr><td width="110" align="right">操作系统：</td><td><?php echo @constant('PHP_OS');?>
</td><td width="90" align="right">系统开发：</td><td><a href="#" target="_blank">ICFrame框架</a></td></tr>
                    <tr><td align="right">Web服务器：</td><td><?php echo $_SERVER['SERVER_SOFTWARE'];?>
</td><td align="right">主页：</td><td><a href="https://user.qzone.qq.com/2273465837/infocenter" target="_blank">疯子也有梦</a></td></tr>
                    <tr><td align="right">服务器IP：</td><td><?php echo $_SERVER['SERVER_ADDR'];?>
</td><td align="right">演示：</td><td><a href="#" target="_blank">http://www.blog.com</a></td></tr>
                    <tr><td align="right">数据库：</td><td>MySQL</td><td align="right">群交流：</td><td><a href="https://jq.qq.com/?_wv=1027&k=5xxSt65" target="_blank">白衣少侠</a> (点击加入“飞翔”)</td></tr>
                </table>
            </div>
        </div>
    </div>
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建   来源:<a href="#" target="_blank">白衣少侠</a></p>
</div>
</body>
</html><?php }
}
