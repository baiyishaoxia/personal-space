<?php
/* Smarty version 3.1.29, created on 2018-04-19 13:01:08
  from "D:\php\BK\App\Home\View\Public\about.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad82294a3cd63_98552696',
  'file_dependency' => 
  array (
    '50b255c7ae5ead5e5b0ae4afa5603e2cbf4c1c0d' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\Public\\about.html',
      1 => 1502870656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad82294a3cd63_98552696 ($_smarty_tpl) {
?>
<div class="avatar"><a href="index.php?p=Home&c=SinglePage&a=index&page_id=1" style="background: url(/Uploads/headerthumb/<?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['headerthumb'];?>
) no-repeat; background-size: 160px 160px;"><span>关于Tangzhifu</span></a></div>
<div class="topspaceinfo">
      <h1><?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['aboutname'];?>
</h1> 
      <p><?php echo $_smarty_tpl->tpl_vars['masterInfo']->value['signature'];?>
</p> 
</div><?php }
}
