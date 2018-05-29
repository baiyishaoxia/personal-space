<?php
/* Smarty version 3.1.29, created on 2018-04-19 13:25:09
  from "D:\php\BK\App\Back\View\Category\recycle.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad828359e28e9_26689213',
  'file_dependency' => 
  array (
    'b94ee29a49104104a3104ad97f4a50d0bc82d579' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\Category\\recycle.html',
      1 => 1524114022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5ad828359e28e9_26689213 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/php/BK/Vendor/Smarty/plugins\\modifier.date_format.php';
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
	//定义页面载入事件
	$(function(){
		//获取btnAdd按钮
		$('#btnIndex').bind('click',function(){
			// 设置“分类首页”链接
			window.location.href = 'index.php?p=Back&c=Category&a=index';
		});
	});
<?php echo '</script'; ?>
>

<div class="admin">
	<form  method="POST" name="dereform"> 
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>分类列表</strong></div>
        <div class="padding border-bottom">
            <input type="button" class="button button-small checkall" name="checkall" checkfor="cate_id[]" value="全选" />
            <input type="button" id="btnIndex" class="button button-small border-green" value="分类首页" />
            <input type="button" class="button button-small border-yellow"  value="批量彻底删除" onclick="if(confirm('确定要全部删除吗？'))realDelAll()" />
			<input type="button"  class="button button-small border-blue" value="一键还原" onclick="if(confirm('确定要一键恢复吗？'))restore()"/>
        </div>
        <table class="table table-hover">
        	<tr>
                <th width="55">选择</th>
                <th width="100">所属类别</th>
                <th width="120">分类名称</th>
				<th width="180">分类描述</th>
                <th width="100">删除时间</th>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['cateInfo']->value;
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
                <td><input type="checkbox" name="cate_id[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_pid'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_desc'];?>
</td>
                <td><?php if ($_smarty_tpl->tpl_vars['row']->value['del_time'] == 0) {?>暂未删除
				    <?php } else { ?> <?php echo smarty_modifier_date_format(($_smarty_tpl->tpl_vars['row']->value['del_time']),'%Y-%m-%d,%T');?>

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
<?php echo '<script'; ?>
 type="text/javascript">
/*一键还原*/
function restore() {
document.dereform.action="index.php?p=Back&c=Category&a=restore";
document.dereform.submit();
}
/*批量删除*/
function realDelAll() {
document.dereform.action="index.php?p=Back&c=Category&a=realDelAll";
document.dereform.submit();
}
<?php echo '</script'; ?>
>
    <br />
    <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
