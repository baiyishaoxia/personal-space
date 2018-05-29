<?php
/* Smarty version 3.1.29, created on 2018-03-29 00:25:28
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/role_index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abbc1f8077e52_91617084',
  'file_dependency' => 
  array (
    'cd0785df134aad3ae280dc3c5a74c143c8ceaf18' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/role_index.html',
      1 => 1522254322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abbc1f8077e52_91617084 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/www/wwwroot/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.truncate.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 设置“角色管理”链接
			window.location.href = 'index.php?p=Back&c=AuthManager&a=addRole';
		});
	});
    $(function(){
        //获取btnAdd按钮
        $('#btnAuthList').bind('click',function(){
            // 设置“权限列表”链接
            window.location.href = 'index.php?p=Back&c=AuthManager&a=authList';
        });
    });
<?php echo '</script'; ?>
>
<div class="admin">
	<form action="index.php?p=Back&c=AuthManager&a=recycleRole" method="POST">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>角色管理</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="role_id[]" value="全选" />
            <input type="button" id="btnAdd" class="button button-small border-green" value="添加角色" />
            <input type="button" id="btnAuthList" class="button button-small border-blue " value="权限列表" />
            <input type="submit" class="button button-small border-yellow"  value="回收站" onclick=" return confirm('确认进入回收站吗?')" />
        </div>
        <table class="table table-hover">
        	<tr>
                <th width="45">选择</th>
                <th width="120">角色ID</th>
                <th width="100">角色名称</th>
                <th width="300">拥有的权限ids</th>
                <th colspan="3">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['roleInfo']->value;
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
                <td><input type="checkbox" name="role_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['role_name'];?>
</td>
                <td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['row']->value['role_auth_ids'],80);?>
</td>
                <td>
                    <a class="button button-small border-green" href="index.php?p=Back&c=AuthManager&a=distribute&role_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
" onclick="return confirm('确认要更改该用户权限吗?')">分配权限</a>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=AuthManager&a=editRole&role_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
">修改</a> 
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=AuthManager&a=delRole&role_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
" >删除</a>
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
