<?php
/* Smarty version 3.1.29, created on 2018-03-17 04:56:52
  from "D:\php\BK\App\Back\View\AuthManager\auth_edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aaca014cedfb3_61336825',
  'file_dependency' => 
  array (
    '8275903ed35ccd562721593447e17dd58e4db9d9' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\AuthManager\\auth_edit.html',
      1 => 1521262608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aaca014cedfb3_61336825 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>权限管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改权限</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=editAuth">
          <input type="hidden" name="auth_id" value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_id'];?>
">
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限名称</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="auth_name" size="50" placeholder="权限名称" data-validate="required:请填写您的权限名称" value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_name'];?>
"/>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限上级</label>
            </div>
            <div class="field">
               <select class="select" name="ad_role_id" >
               	  <option value="0">Root权限</option>
                  <?php
$_from = $_smarty_tpl->tpl_vars['auth_infoA']->value;
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
                  <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['auth_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['auth_Info']->value['auth_pid'] == $_smarty_tpl->tpl_vars['row']->value['auth_id']) {?> selected="selected" <?php }?> >
                  <?php echo $_smarty_tpl->tpl_vars['row']->value['auth_name'];?>

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
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限控制器</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="auth_c" size="50"  value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_c'];?>
" />
            </div>
          </div>

          <div class="form-group">
            <div class="label">
              <label for="siteurl">权限操作方法</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="sort" name="auth_a" size="50"  value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_a'];?>
"  />
            </div>
          </div>

          <div class="form-group">
            <div class="label">
              <label for="siteurl">全路径</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="sort" name="auth_path" size="50"  value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_path'];?>
"  />
            </div>
          </div>

          <div class="form-group">
            <div class="label">
              <label for="siteurl">等级</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="sort" name="auth_level" size="50"  value="<?php echo $_smarty_tpl->tpl_vars['auth_Info']->value['auth_level'];?>
"  />
            </div>
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
