<?php
/* Smarty version 3.1.29, created on 2018-05-08 08:56:24
  from "D:\php\BK\App\Home\View\Public\copyright.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5af0f5b8b39406_15921048',
  'file_dependency' => 
  array (
    '32510d06d6943084be32a60f7e0d1e3086e0b2f1' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\Public\\copyright.html',
      1 => 1525700635,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af0f5b8b39406_15921048 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/php/BK/Vendor/Smarty/plugins\\modifier.date_format.php';
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
