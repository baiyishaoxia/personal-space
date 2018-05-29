<?php
/* Smarty version 3.1.29, created on 2018-03-28 22:19:33
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abba4754fa184_20227570',
  'file_dependency' => 
  array (
    '267b795726b21cc6e86d8ed44b7bbcd07bea2e33' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/index.html',
      1 => 1521607740,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abba4754fa184_20227570 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnRole按钮
		$('#btnRole').bind('click',function(){
			// 设置“角色管理”链接
			window.location.href = 'index.php?p=Back&c=AuthManager&a=role';
		});
	});
    //定义页面载入事件
    $(function(){
        //获取btnAdd按钮
        $('#btnAdd').bind('click',function(){
            // 设置“回收站”链接
            window.location.href = 'index.php?p=Back&c=AuthManager&a=addAdmin';
        });
    });
<?php echo '</script'; ?>
>
<div class="admin">
	<form action="index.php?p=Back&c=AuthManager&a=authList" method="POST">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>管理员列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="admin_id[]" value="全选" />
            <input type="button" id="btnRole" class="button button-small border-green" value="角色管理" />
            <input type="submit" class="button button-small border-yellow"  value="权限列表" onclick=" return confirm('确认进入权限列表吗?')" />
            <input type="button" id="btnAdd" class="button border-blue button-small" value="添加管理员" />
        </div>
        <table class="table table-hover">
        	<tr>
                <th width="45">选择</th>
                <th width="120">管理员ID</th>
                <th width="200">用户名</th>
                <th width="200">当前充当角色</th>
                <th width="100">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['AdminInfo']->value;
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
                <td><input type="checkbox" name="admin_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['admin_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['admin_id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['admin_name'];?>
</td>
                 <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['row']->value['role_name'])===null||$tmp==='' ? '超级管理员' : $tmp);?>
</td>
                <td>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=AuthManager&a=editAdmin&admin_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['admin_id'];?>
">修改</a> 
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=AuthManager&a=delAdmin&admin_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['admin_id'];?>
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
