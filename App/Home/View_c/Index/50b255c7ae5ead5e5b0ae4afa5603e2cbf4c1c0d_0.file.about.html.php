<?php
/* Smarty version 3.1.29, created on 2017-08-16 10:08:18
  from "D:\php\BK\App\Home\View\Public\about.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5993fd723a08a8_39343883',
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
function content_5993fd723a08a8_39343883 ($_smarty_tpl) {
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
