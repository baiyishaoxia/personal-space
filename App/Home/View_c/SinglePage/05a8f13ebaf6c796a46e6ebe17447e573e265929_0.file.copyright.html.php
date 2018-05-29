<?php
/* Smarty version 3.1.29, created on 2018-03-29 23:39:31
  from "/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/copyright.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abd08b3b0d5d5_11724114',
  'file_dependency' => 
  array (
    '05a8f13ebaf6c796a46e6ebe17447e573e265929' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Home/View/Public/copyright.html',
      1 => 1522337363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abd08b3b0d5d5_11724114 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/www/wwwroot/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.date_format.php';
?>
    <div class="copyright">
      <ul>
        <p> Design by <a href="/">白衣少侠</a></p>
        <p>湖南@备案@白衣工作室-1</p>
        <p>©CopyRight 2017-<?php echo smarty_modifier_date_format(time(),"%Y");?>
 白衣工作室  版权所有</p>
        </p>
      </ul>
    </div><?php }
}
