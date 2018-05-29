<?php
/* Smarty version 3.1.29, created on 2018-03-31 08:37:17
  from "/www/tzf.afu666.xyz/App/Home/View/Public/about.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abf48bdd159b3_21502611',
  'file_dependency' => 
  array (
    'beac86eb19042c93092d2398c8beaaa3f8d0e900' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Home/View/Public/about.html',
      1 => 1502870656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abf48bdd159b3_21502611 ($_smarty_tpl) {
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
