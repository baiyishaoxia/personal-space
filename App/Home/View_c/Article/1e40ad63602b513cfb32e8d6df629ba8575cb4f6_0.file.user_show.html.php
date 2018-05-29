<?php
/* Smarty version 3.1.29, created on 2018-05-08 10:34:24
  from "D:\php\BK\App\Home\View\Article\user_show.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5af10cb04849d2_81638389',
  'file_dependency' => 
  array (
    '1e40ad63602b513cfb32e8d6df629ba8575cb4f6' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\Article\\user_show.html',
      1 => 1525744947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/meta.html' => 1,
    'file:../Public/header.html' => 1,
  ),
),false)) {
function content_5af10cb04849d2_81638389 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/php/BK/Vendor/Smarty/plugins\\modifier.date_format.php';
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
/style.css" rel="stylesheet">
<link href="<?php echo @constant('CSS_DIR');?>
/media.css" rel="stylesheet">
<style type="text/css">
  .ds-replybox img {
    float:left;
    width:76px;
    height:76px;
  }
  textarea {
    box-shadow: none;
    color: #999;
    height: 54px;
    margin: 0;
    overflow: auto;
    padding: 10px;
    resize: none;
    width: 80%;
    margin-left:10px;
  }
  button {
    margin-top:10px;
    margin-left:85px;
    font-size: 14px;
    font-weight: bold;
    height: 32px;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    transition: all 0.15s linear 0s;
    width: 100px;
  }
  .otherlink dl {
    display:block;
    width:100%;
    height:65px;
    padding:20px 0;
    border-bottom:1px #DEDEDE solid;
  }
  .otherlink dt {
    float:left;
  }
  .otherlink h3 {
    color:#D23;
  }
  .otherlink h3,.otherlink p {
    line-height:22px;
    text-indent:10px;
  }
  .otherlink .msg {
     color:#333;
  }
  .otherlink .addtime {
     color:#999;
  }
  .logform input {
    width:140px;
    height:30px;
  }
</style>
  <?php echo '<script'; ?>
 src="<?php echo @constant('JS_DIR');?>
/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src='<?php echo @constant('JS_DIR');?>
/prefixfree.min.js'><?php echo '</script'; ?>
>
  <style class="cp-pen-styles">
  body {
    background: radial-gradient(200% 100% at bottom center, #0070aa, #0b2570, #000035, #000);
    background: radial-gradient(220% 105% at top center, #000 10%, #000035 40%, #0b2570 65%, #0070aa);
    background-attachment: fixed;
    overflow: hidden;
  }

  @keyframes rotate {
    0% {
      transform: perspective(400px) rotateZ(20deg) rotateX(-40deg) rotateY(0);
    }
    100% {
      transform: perspective(400px) rotateZ(20deg) rotateX(-40deg) rotateY(-360deg);
    }
  }
  .stars {
    transform: perspective(500px);
    transform-style: preserve-3d;
    position: absolute;
    bottom: 0;
    perspective-origin: 50% 100%;
    left: 50%;
    animation: rotate 90s infinite linear;
  }

  .star {
    width: 2px;
    height: 2px;
    background: #F7F7B6;
    position: absolute;
    top: 0;
    left: 0;
    transform-origin: 0 0 -300px;
    transform: translate3d(0, 0, -300px);
    backface-visibility: hidden;
  }
  </style>

</head>
<body>
<!-- 背景图 -->
<div class="stars" style=""></div>
<!-- 正文 -->
<div class="ibody" style="height:620px;z-index: -1;position:absolute;left: 200px">

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <article style="margin-bottom: 110px">
    <div style="position: absolute;left:30px;top:220px;"> <img src="/Uploads/user/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['usermassage']->value['user_image'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['row']->value['user_image'] : $tmp);?>
" width="130" height="130" style="float:left;border-radius: 50%">
    </div>
    <div style="margin-top: 50px;margin-left:200px;font-size:20px"> 
              用户名：<?php echo $_smarty_tpl->tpl_vars['usermassage']->value['user_name'];?>
  <br />
              用户邮箱：<?php echo (($tmp = @$_smarty_tpl->tpl_vars['usermassage']->value['user_email'])===null||$tmp==='' ? '未填写' : $tmp);?>
 <br />
              用户状态：<?php if ($_smarty_tpl->tpl_vars['usermassage']->value['user_type'] == '0') {?> 正常 <?php } else { ?> <span style="color: red">已注销</span><?php }?><br />
              注册时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['usermassage']->value['user_time'],'%Y-%m-%d %H:%M:%S');?>
 <br />
              最近登录时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['usermassage']->value['login_time'],'%Y-%m-%d %H:%M:%S');?>
 <br />
              
    </div>
       
  </article>
   <p style="color: yellow;font-size: 20px">最近访客</p>
    <ul>
       <?php
$_from = $_smarty_tpl->tpl_vars['laterUser']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_i_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_i']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_i'] : false;
$__foreach_i_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_i'] = new Smarty_Variable(array('iteration' => 0));
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration']++;
$__foreach_i_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
                 <?php if (((isset($_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration'] : null)%6) > 5) {?>  <br><br><?php }?>
       <a href="index.php?p=Home&c=Article&a=usershow&user_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
">
       <img src="/Uploads/user/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['row']->value['user_thumb'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['row']->value['user_image'] : $tmp);?>
" width="40" height="40" style="float:left;border-radius: 50%"> 
       </a>  
       <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_i_0_saved_local_item;
}
if ($__foreach_i_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_i'] = $__foreach_i_0_saved;
}
if ($__foreach_i_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_i_0_saved_item;
}
?>
    </ul>

  <?php echo '<script'; ?>
 src="js/silder.js"><?php echo '</script'; ?>
>
  <div class="clear"></div>
</div>

</body>
<?php echo '<script'; ?>
>
  $(document).ready(function () {
      var stars = 800;
      var $stars = $('.stars');
      var r = 800;
      for (var i = 0; i < stars; i++) {
          if (window.CP.shouldStopExecution(1)) {
              break;
          }
          var $star = $('<div/>').addClass('star');
          $stars.append($star);
      }
      window.CP.exitedLoop(1);
      $('.star').each(function () {
          var cur = $(this);
          var s = 0.2 + Math.random() * 1;
          var curR = r + Math.random() * 300;
          cur.css({
              transformOrigin: '0 0 ' + curR + 'px',
              transform: ' translate3d(0,0,-' + curR + 'px) rotateY(' + Math.random() * 360 + 'deg) rotateX(' + Math.random() * -50 + 'deg) scale(' + s + ',' + s + ')'
          });
      });
  });

  <?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src='<?php echo @constant('JS_DIR');?>
/stopExecutionOnTimeout.js'><?php echo '</script'; ?>
>
</html>
<?php }
}
