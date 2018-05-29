<?php
/* Smarty version 3.1.29, created on 2018-04-19 04:41:20
  from "D:\php\BK\App\Home\View\User\register.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad81df004bb19_22067875',
  'file_dependency' => 
  array (
    '6c90f7722b88e772395879abdeec7a3b4192bb4a' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\User\\register.html',
      1 => 1522765050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/meta.html' => 1,
    'file:../Public/header.html' => 1,
    'file:../Public/about.html' => 1,
    'file:../Public/copyright.html' => 1,
  ),
),false)) {
function content_5ad81df004bb19_22067875 ($_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/meta.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link href="<?php echo @constant('CSS_DIR');?>
/base.css" rel="stylesheet">
<link href="<?php echo @constant('CSS_DIR');?>
/index.css" rel="stylesheet">
<link href="<?php echo @constant('CSS_DIR');?>
/media.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo @constant('CSS_DIR');?>
/login/login.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/register.js"><?php echo '</script'; ?>
>
<!--[if lt IE 9]>
<?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/modernizr.js"><?php echo '</script'; ?>
>
<![endif]-->
</head>
<style type="text/css">
.bloglist{
 background-color:;
}
.zhuce{
  margin-left:80px;
  color:red;
  font-size:16px;
  }
</style>
<!--已完善-->
<?php echo '<script'; ?>
 type="text/javascript">
  window.onload=function(){
  document.getElementById('username').onblur=function(){  //当鼠标离开的时候
    var username=encodeURIComponent(this.value) ;   //编码(兼容中文、get方式的传递形式[name&age=18])
    var req=new XMLHttpRequest();    //实例化
    req.open('post',"<?php echo @constant('SITE_URL');?>
"+'/index.php?p=Home&c=User&a=Checkregister');  //以post形式建立对服务器的连接
    req.onreadystatechange=function(){     //当状态发生改变的时候
      if(req.readyState==4 && req.status==200){
        var flag=parseInt(req.responseText);  //接收服务器返回的字符串并转整
        if(flag){      //如果返回值为1(存在)、0(不存在)
          //alert('此用户名已经存在！');
                    document.getElementById('nm').innerHTML="<font color='red'>此用户名已经存在！</font>";
          document.getElementById('username').select(); //选中当前
          return false;
        }else{
          if(document.getElementById("username").value.length < 1)
               document.getElementById('nm').innerHTML="<font color='red'>对不起，用户名不可以为空！</font>";
          //alert('恭喜你，用户名可以注册！');
          else document.getElementById('nm').innerHTML="<font color='blue'>恭喜你，用户名可以注册！</font>";
        }
      }

    }
    req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');  //post方式要用引入头
    req.send('username='+username);  //对服务器发起请求
  }
}
<?php echo '</script'; ?>
>
<!--Ajax验证到此结束-->
<body>
<div class="ibody">
  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <article>
    <div class="banner">
      <ul class="texts">
         <?php echo $_smarty_tpl->tpl_vars['bannerInfo']->value['title'];?>

      </ul>
    </div>
<a href="#"  name="tipsregister"></a>
    <div class="bloglist">
      <h2>
        <p><span>用户</span>注册</p>
      </h2>
      <div>
<!--会员注册-->
<div class="dataEye">
<div class="loginbox">
    <div class="login-content" style="width:310px;margin: 10px auto 10px 5px;">
      <div class="loginbox-title">
        <h3>用户注册(*号为必填信息项)</h3>
      </div>
      <form name="theform" method="POST" action="index.php?p=Home&c=User&a=dealRegister" enctype="multipart/form-data">
      <div class="login-error"></div>
      <div class="row">
        <input type="text" class="input-text-user input-click" name="user_name" id="username" placeholder="用户名" style="width:265px;"/><br/>
        <span class="pb" id="nm">*请填写您的用户名</span>
      </div>
      <div class="row">
        <input type="file" class="input-text-file input-click" name="user_image"  style="width:265px;"/><br/>
        <span class="pb">请选择您的头像</span> 
      </div>
      <div class="row">
        <input type="email" class="input-text-email input-click" name="user_email" placeholder="邮箱" style="width:265px;" /><br/>
        <span>*请输入您常用的邮箱</span> 
      </div>
      <div class="row">
        <input type="password" class="input-text-password input-click" name="pass1" id="password" placeholder="密码" onblur="return checkLength()" style="width:265px;"/><br/>
        <span id="errorpwd1" style="display:none;color:red">输入密码长度不足6位</span>
      </div>
      <div class="row">
        <input type="password" class="input-text-password input-click" name="pass2" id="password2" placeholder="确认密码" onblur="return checkPass()" style="width:265px;"/><br/>
        <span id="errorpwd2" style="display:none;color:red">两次密码输入不一致</span>
      </div>
      <div class="row">
        <input type="text" class="input-text-verify input-click" name="verifycode"  placeholder="验证码(看不清？点击换一张)" style="width:185px;float
        :left" />
        <img src="index.php?p=Home&c=User&a=captcha" onclick="this.src='index.php?p=Home&c=User&a=captcha&n='+Math.random()" width="80" height="32" style="float
        :left" />
      </div> 
      <div class="row btnArea">
        <input type="submit" value="立即注册" class="login-btn" id="submit" style="width:310px;">
      </div>
      </form>
    </div>
    <div class="go-regist">
      已有账号？请
      <a href="index.php?p=Home&c=User&a=login">前往登录</a>
    </div>
  </div>
</div>
<!--会员注册结束-->  
  </article>
  <aside>
   <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/about.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <!--关于-->
    <div class="about_c">
      <p>网名：<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['nickname'];?>
</p>
      <p>职业：<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['job'];?>
 </p>
      <p>籍贯：<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['home'];?>
</p>
      <p>电话：<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['tel'];?>
</p>
      <p>邮箱：<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['email'];?>
</p>
    </div>
<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>

<?php echo '<script'; ?>
>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];<?php echo '</script'; ?>
>

    <div class="tj_news">
      <h2>
        <p class="tj_t1">最新文章</p>
      </h2>
      <ul>
        <?php
$_from = $_smarty_tpl->tpl_vars['newArt']->value;
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
        <li><a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></li>
        <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
      </ul>
      <h2>
        <p class="tj_t2">推荐文章</p>
      </h2>
      <ul>
        <?php
$_from = $_smarty_tpl->tpl_vars['rmdArtByHits']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_1_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_1_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
        <li><a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></li>
        <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_1_saved_local_item;
}
if ($__foreach_row_1_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_1_saved_item;
}
?>
      </ul>
    </div>
    <div class="links">
      <h2>
        <p>友情链接</p>
      </h2>
      <ul>
	  <?php
$_from = $_smarty_tpl->tpl_vars['friendInfo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_2_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_2_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['frd_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['frd_name'];?>
</a></li>
	  <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_local_item;
}
if ($__foreach_row_2_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_item;
}
?>
      </ul>
    </div>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/copyright.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  </aside>
  <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/silder.js"><?php echo '</script'; ?>
>
  <div class="clear"></div>
  <!-- 清除浮动 -->
</div>
</body>
</html>
<?php }
}
