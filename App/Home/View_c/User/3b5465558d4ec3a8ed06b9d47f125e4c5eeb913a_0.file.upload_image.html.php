<?php
/* Smarty version 3.1.29, created on 2018-03-29 11:41:46
  from "/www/wwwroot/tzf.afu666.xyz/App/Home/View/User/upload_image.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abc607a33ab53_47688521',
  'file_dependency' => 
  array (
    '3b5465558d4ec3a8ed06b9d47f125e4c5eeb913a' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Home/View/User/upload_image.html',
      1 => 1503216154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abc607a33ab53_47688521 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>请上传头像</title>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST" action="index.php?p=Home&c=User&a=upload_image_deal" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" value="点击上传">
	</form>
</body>
</html><?php }
}
