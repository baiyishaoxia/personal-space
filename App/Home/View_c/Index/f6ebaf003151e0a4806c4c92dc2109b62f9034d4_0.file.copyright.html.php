<?php
/* Smarty version 3.1.29, created on 2018-03-31 07:10:11
  from "/www/tzf.afu666.xyz/App/Home/View/Public/copyright.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abf345302f0d1_23786250',
  'file_dependency' => 
  array (
    'f6ebaf003151e0a4806c4c92dc2109b62f9034d4' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Home/View/Public/copyright.html',
      1 => 1522337362,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abf345302f0d1_23786250 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/www/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.date_format.php';
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
