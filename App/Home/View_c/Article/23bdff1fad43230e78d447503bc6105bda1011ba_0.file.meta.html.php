<?php
/* Smarty version 3.1.29, created on 2018-03-29 08:22:42
  from "/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/meta.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abc31d2988264_34176685',
  'file_dependency' => 
  array (
    '23bdff1fad43230e78d447503bc6105bda1011ba' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/meta.html',
      1 => 1520951426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abc31d2988264_34176685 ($_smarty_tpl) {
?>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
<style type="text/css">
.banner { background: url(<?php echo @constant('BANNER_DIR');?>
/<?php echo $_smarty_tpl->tpl_vars['bannerInfo']->value['img'];?>
) no-repeat center; height: 290px; margin: 10px auto; width: 100%; font-size: 16px; font-family: "Microsoft Yahei", Arial, Helvetica, sans-serif; }
</style><?php }
}
