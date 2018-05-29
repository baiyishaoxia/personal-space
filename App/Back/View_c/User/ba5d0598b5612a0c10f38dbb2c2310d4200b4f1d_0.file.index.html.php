<?php
/* Smarty version 3.1.29, created on 2018-04-19 04:42:48
  from "D:\php\BK\App\Back\View\User\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad81e48e9f768_86166673',
  'file_dependency' => 
  array (
    'ba5d0598b5612a0c10f38dbb2c2310d4200b4f1d' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\User\\index.html',
      1 => 1522391154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5ad81e48e9f768_86166673 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/php/BK/Vendor/Smarty/plugins\\modifier.date_format.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnAdd').bind('click',function(){
			// 设置“添加用户”链接
			window.location.href = 'index.php?p=Back&c=User&a=add';
		});
	});
<?php echo '</script'; ?>
>
<div class="admin">
	<form action="index.php?p=Back&c=User&a=delAll" method="POST">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>用户列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="user_id[]" value="全选" />
            <input type="button" id="btnAdd" class="button button-small border-green" value="添加用户" />
            <input type="submit" class="button button-small border-yellow"  value="批量删除" onclick=" return confirm('确认全部删除吗?')" />
        </div>
        <table class="table table-hover">
        	<tr>
                <th width="50">选择</th>
                <th width="80">用户ID</th>
                <th width="60">用户名</th>
				<th width="60">用户密码(md5加密后)</th>
                <th width="100">邮箱</th>
				<th width="80">用户头像</th>
                <th width="180">注册时间</th>
                <th width="120">操作 状态</th>
            </tr>

            <?php
$_from = $_smarty_tpl->tpl_vars['userInfo']->value;
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
                <td><input type="checkbox" name="user_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['user_name'];?>
</td> 
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['user_pass'];?>
</td>
                <td><?php echo (($tmp = @$_smarty_tpl->tpl_vars['row']->value['user_email'])===null||$tmp==='' ? '暂未设置' : $tmp);?>
</td>
				<td><img src="/Uploads/user/<?php echo $_smarty_tpl->tpl_vars['row']->value['user_thumb'];?>
" width="40" height="40px"/></td>

				<td><?php echo smarty_modifier_date_format(($_smarty_tpl->tpl_vars['row']->value['user_time']),'%Y-%m-%d %H:%M:%S');?>
</td>
                <td>
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=User&a=del&user_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
" onclick="return confirm('确认删除吗?')">删除</a>
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['user_type'] == '1') {?>
                    <a class="button border-yellow button-little" href="index.php?p=Back&c=User&a=ifUserBlack&user_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
&is_type=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_type'];?>
&pageNum=<?php echo (($tmp = @$_GET['pageNum'])===null||$tmp==='' ? 1 : $tmp);?>
">已停用</a> 
                    <?php } else { ?>
                    <a class="button border-blue button-little" href="index.php?p=Back&c=User&a=ifUserBlack&user_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_id'];?>
&is_type=<?php echo $_smarty_tpl->tpl_vars['row']->value['user_type'];?>
&pageNum=<?php echo (($tmp = @$_GET['pageNum'])===null||$tmp==='' ? 1 : $tmp);?>
">正常</a> 
                    <?php }?>
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
		<div class="panel-foot text-center">
            <?php echo $_smarty_tpl->tpl_vars['strPage']->value;?>

        </div>
    </div>
    </form>
    <br />
    <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
