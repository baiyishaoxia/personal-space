<?php
/* Smarty version 3.1.29, created on 2018-04-19 13:24:24
  from "D:\php\BK\App\Home\View\Public\meta.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad82808a6f193_28055476',
  'file_dependency' => 
  array (
    '0839c1c5e6a738cfc717b38c30c91c4e95d39e18' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\Public\\meta.html',
      1 => 1523352462,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad82808a6f193_28055476 ($_smarty_tpl) {
?>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="icon" href="<?php echo @constant('SITE_URL');?>
/Public/ico/favicon.ico" type="image/x-icon">
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
<style type="text/css">
.banner { background: url(<?php echo @constant('BANNER_DIR');?>
/<?php echo $_smarty_tpl->tpl_vars['bannerInfo']->value['img'];?>
) no-repeat center; height: 290px; margin: 10px auto; width: 100%; font-size: 16px; font-family: "Microsoft Yahei", Arial, Helvetica, sans-serif; }
</style>
<?php }
}
