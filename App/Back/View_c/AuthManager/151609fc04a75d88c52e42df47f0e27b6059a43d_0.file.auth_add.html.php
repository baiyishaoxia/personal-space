<?php
/* Smarty version 3.1.29, created on 2018-03-16 16:19:43
  from "D:\php\BK\App\Back\View\AuthManager\auth_add.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aabee9f3a1633_48173658',
  'file_dependency' => 
  array (
    '151609fc04a75d88c52e42df47f0e27b6059a43d' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\AuthManager\\auth_add.html',
      1 => 1521217180,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aabee9f3a1633_48173658 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>权限管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">添加权限</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=addAuth">
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限名称</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="auth_name" size="50" placeholder="权限名称" data-validate="required:请填写您的权限名称" />
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限上级</label>
            </div>
            <div class="field">
                <select name="auth_pid">
                	  <option value="0">-请选择-</option>
                      <?php
$_from = $_smarty_tpl->tpl_vars['auth_InfoA']->value;
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
                      <option value='<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
'> <?php echo $_smarty_tpl->tpl_vars['v']->value['auth_name'];?>
 </option>
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
                </select>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="sitename">权限控制器</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="auth_c" size="50"  />
            </div>
          </div>

          <div class="form-group">
            <div class="label">
              <label for="siteurl">权限操作方法</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="sort" name="auth_a" size="50"  />
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
