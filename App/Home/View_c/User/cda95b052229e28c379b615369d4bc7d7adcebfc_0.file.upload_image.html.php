<?php
/* Smarty version 3.1.29, created on 2018-03-27 09:48:35
  from "D:\php\BK\App\Home\View\User\upload_image.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aba1373c0ba90_61404965',
  'file_dependency' => 
  array (
    'cda95b052229e28c379b615369d4bc7d7adcebfc' => 
    array (
      0 => 'D:\\php\\BK\\App\\Home\\View\\User\\upload_image.html',
      1 => 1503216155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aba1373c0ba90_61404965 ($_smarty_tpl) {
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
