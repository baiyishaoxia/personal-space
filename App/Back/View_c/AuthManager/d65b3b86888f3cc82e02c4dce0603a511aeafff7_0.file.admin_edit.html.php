<?php
/* Smarty version 3.1.29, created on 2018-03-29 00:37:32
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/admin_edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abbc4cce1dd87_29486004',
  'file_dependency' => 
  array (
    'd65b3b86888f3cc82e02c4dce0603a511aeafff7' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/admin_edit.html',
      1 => 1521184004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abbc4cce1dd87_29486004 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>//引入在线编辑器<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>关于管理员</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改管理员</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=dealEditAdmin&admin_id=<?php echo $_smarty_tpl->tpl_vars['adminInfo']->value['admin_id'];?>
">
          <div class="form-group">
            <div class="label">
              <label for="sitename">用户名</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="admin_name" size="50" placeholder="用户名称" data-validate="required:请填写您的用户名称" value="<?php echo $_smarty_tpl->tpl_vars['adminInfo']->value['admin_name'];?>
" />
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">用户密码</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="admin_pass" size="50" placeholder="用户密码" data-validate="required:请填写您的用户密码" value="<?php echo $_smarty_tpl->tpl_vars['adminInfo']->value['admin_pass'];?>
" />
            </div>
          </div>
		  <div class="form-group">
            <div class="label">
              <label for="sitename">充当的角色</label>
            </div>
               <select class="select" name="ad_role_id" >
               	  <option value="0">Root权限</option>

                  <?php
$_from = $_smarty_tpl->tpl_vars['RoleInfo']->value;
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
" <?php if ($_smarty_tpl->tpl_vars['adminInfo']->value['ad_role_id'] == $_smarty_tpl->tpl_vars['row']->value['role_id']) {?>selected="selected"<?php }?>>
                  <?php echo $_smarty_tpl->tpl_vars['row']->value['role_name'];?>

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
            <button class="button bg-main" type="submit">提交</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div style='height:20px; border-bottom:1px #DDD solid'></div>
  <p class="text-right text-gray" style="float:right">基于<a class="text-gray" target="_blank" href="#">MVC框架</a>构建</p>
</div>
</body>
</html><?php }
}
