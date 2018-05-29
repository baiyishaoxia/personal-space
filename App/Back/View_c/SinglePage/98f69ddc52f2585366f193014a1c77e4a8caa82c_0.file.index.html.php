<?php
/* Smarty version 3.1.29, created on 2018-04-09 14:13:08
  from "/www/tzf.afu666.xyz/App/Back/View/SinglePage/index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5acb74f4d6b1c8_75790057',
  'file_dependency' => 
  array (
    '98f69ddc52f2585366f193014a1c77e4a8caa82c' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Back/View/SinglePage/index.html',
      1 => 1502867548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5acb74f4d6b1c8_75790057 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/www/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.truncate.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 设置“添加单页”链接
			window.location.href = 'index.php?p=Back&c=SinglePage&a=add';
		});
	});
<?php echo '</script'; ?>
>
<div class="admin">
	<form action="index.php?p=Back&c=SinglePage&a=delAll" method="POST">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>单页列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="page_id[]" value="全选" />
            <input type="button" id="btnAdd" class="button button-small border-green" value="添加单页" />
            <input type="submit" class="button button-small border-yellow"  value="批量删除" onclick=" return confirm('确认全部删除吗?')" />
        </div>
        <table class="table table-hover">
        	<tr>
                <th width="45">选择</th>
                <th width="120">单页ID</th>
                <th width="200">单页标题</th>
                <th width="100">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['pageInfo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
            <tr>
                <td><input type="checkbox" name="single_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['page_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['page_id'];?>
</td>
                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['row']->value['title'],10);?>
</td>
                <td>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=SinglePage&a=edit&page_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['page_id'];?>
">修改</a> 
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=SinglePage&a=del&page_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['page_id'];?>
" onclick="return confirm('确认删除吗?')">删除</a>
                </td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
        </table>
    </div>
    </form>
    <br />
    <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
