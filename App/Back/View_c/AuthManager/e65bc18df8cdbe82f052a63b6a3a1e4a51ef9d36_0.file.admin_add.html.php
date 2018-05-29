<?php
/* Smarty version 3.1.29, created on 2018-03-16 05:25:07
  from "D:\php\BK\App\Back\View\AuthManager\admin_add.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aab553312c893_23212550',
  'file_dependency' => 
  array (
    'e65bc18df8cdbe82f052a63b6a3a1e4a51ef9d36' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\AuthManager\\admin_add.html',
      1 => 1521177733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aab553312c893_23212550 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>
//这里引入了在线编辑器
<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>管理员管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">添加管理员</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=dealAddAdmin" enctype="multipart/form-data">
          <div class="form-group">
            <div class="label">
              <label for="sitename">用户名</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="admin_name" size="50" placeholder="用户名" data-validate="required:请填写您的用户名" />
            </div>
          </div>
		    <div class="form-group">
            <div class="label">
              <label for="sitename">用户密码</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="pass1" size="50" placeholder="用户密码" data-validate="required:请填写您的用户密码" />
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">确认密码</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="pass2" size="50" placeholder="确认密码" data-validate="required:请再次填写您的用户密码" />
            </div>
          </div>
		  <div class="form-group">
            <div class="label">
              <label for="sitename">充当的角色</label>
            </div>
               <select class="select" name="ad_role_id" >
               	  <option value="0">Root权限</option>
                  <?php
$_from = $_smarty_tpl->tpl_vars['adminInfo']->value;
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
                  <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['role_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['role_name'];?>
</option>
                  <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
              </select>
          </div>


          <div class="form-button">
            <button name="submit" class="button bg-main" type="submit">提交</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div style='height:40px; border-bottom:1px #DDD solid'></div>
  <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
