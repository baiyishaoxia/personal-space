<?php
/* Smarty version 3.1.29, created on 2018-04-10 09:27:46
  from "/www/tzf.afu666.xyz/App/Home/View/Public/meta.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5acc83925df4b7_52732623',
  'file_dependency' => 
  array (
    '06667399a3b1bfa6dad436ef1b5dc8d077206a5b' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Home/View/Public/meta.html',
      1 => 1523352462,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5acc83925df4b7_52732623 ($_smarty_tpl) {
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
