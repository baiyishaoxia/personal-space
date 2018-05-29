<?php
/* Smarty version 3.1.29, created on 2018-03-16 03:54:53
  from "D:\php\BK\App\Back\View\AuthManager\role_edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aab400d06a537_01435123',
  'file_dependency' => 
  array (
    '7ea924db65fc20b4e62c8e088d461861e9f45a67' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\AuthManager\\role_edit.html',
      1 => 1521172477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aab400d06a537_01435123 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>//引入在线编辑器<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>关于角色</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改角色</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=dealEditRole&role_id=<?php echo $_smarty_tpl->tpl_vars['roleInfo']->value['role_id'];?>
">
          <div class="form-group">
            <div class="label">
              <label for="sitename">角色名称</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="role_name" size="50" placeholder="角色名称" data-validate="required:请填写您的角色名称" value="<?php echo $_smarty_tpl->tpl_vars['roleInfo']->value['role_name'];?>
" />
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
