<?php
/* Smarty version 3.1.29, created on 2018-03-29 15:09:21
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/auth_index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abc9121890433_65578059',
  'file_dependency' => 
  array (
    'eee1731b64f1f650e4d7a73623399aa8f6039136' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/auth_index.html',
      1 => 1522307359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abc9121890433_65578059 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 添加权限的链接
			window.location.href = 'index.php?p=Back&c=AuthManager&a=addAuth';
		});
	});
	//定义页面载入事件
    $(function(){
        //获取btnAdd按钮
        $('#btnRecycle').bind('click',function(){
            // 设置“回收站”链接
            window.location.href = 'index.php?p=Back&c=AuthManager&a=recycleAuth';
        });
    });
<?php echo '</script'; ?>
>
<div class="admin">
	<form method="POST" action="index.php?p=Back&c=AuthManager&a=delAllAuth">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>权限列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="auth_id[]" value="全选" />
            <input type="button" id="btnAdd" class="button button-small border-green" value="添加权限" />
            <input type="submit" class="button button-small border-yellow" value="批量删除" onclick="return confirm('确认全部删除吗?')"/>
			<input type="button" id="btnRecycle" class="button button-small border-blue" value="回收站" />
        </div>
        <table class="table table-hover">
		     <tr>
		     	<th width="50">选择</th>
                <th width="80">序号</th>
                <th width="200">权限名称</th>
                <th width="30">父id</th>
                <th width="100">控制器</th>
                <th width="100">操作方法</th>
                <th width="100">全路径</th>
                <th width="30">等级</th>
                <th width="100">操作</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['authInfo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_v_0_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$__foreach_v_0_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$__foreach_v_0_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
            <tr>
                <td><input type="checkbox" name="auth_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
</td>
                <td><?php echo preg_replace('!^!m',str_repeat('----',$_smarty_tpl->tpl_vars['v']->value['auth_level']),$_smarty_tpl->tpl_vars['v']->value['auth_name']);?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_pid'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_c'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_a'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_path'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_level'];?>
</td>
                <td>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=AuthManager&a=editAuth&auth_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
">修改</a> 
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=AuthManager&a=delAuth&auth_id=<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
" onclick="return confirm('确认删除吗?')">删除</a>
                </td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_local_item;
}
if ($__foreach_v_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved_item;
}
if ($__foreach_v_0_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_v_0_saved_key;
}
?>
        </table>
        <div class="panel-foot text-center">
            <?php echo $_smarty_tpl->tpl_vars['strPage']->value;?>

        </div>
    </div>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
