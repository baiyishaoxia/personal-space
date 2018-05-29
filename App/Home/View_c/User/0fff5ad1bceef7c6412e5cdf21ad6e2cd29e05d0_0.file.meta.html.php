<?php
/* Smarty version 3.1.29, created on 2018-03-30 16:37:16
  from "D:\php\tzf.afu666.xyz\App\Home\View\Public\meta.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abe67bce4a284_13727439',
  'file_dependency' => 
  array (
    '0fff5ad1bceef7c6412e5cdf21ad6e2cd29e05d0' => 
    array (
      0 => 'D:\\php\\tzf.afu666.xyz\\App\\Home\\View\\Public\\meta.html',
      1 => 1520951426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abe67bce4a284_13727439 ($_smarty_tpl) {
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
