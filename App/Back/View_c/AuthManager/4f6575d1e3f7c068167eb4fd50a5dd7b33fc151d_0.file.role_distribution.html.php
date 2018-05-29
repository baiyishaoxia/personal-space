<?php
/* Smarty version 3.1.29, created on 2018-03-29 00:25:34
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/role_distribution.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abbc1fe893f22_59808343',
  'file_dependency' => 
  array (
    '4f6575d1e3f7c068167eb4fd50a5dd7b33fc151d' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/AuthManager/role_distribution.html',
      1 => 1521186134,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abbc1fe893f22_59808343 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>角色管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">分配权限【<?php echo $_smarty_tpl->tpl_vars['roleInfo']->value['role_name'];?>
】</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=AuthManager&a=distribute">

          <input type="hidden" name="role_id" value="<?php echo $_smarty_tpl->tpl_vars['roleInfo']->value['role_id'];?>
">
          <table width="100%" >
             <input type="button" class="button button-small checkall" name="checkall" checkfor="auth_id[]" value="全选" />
          	<?php
$_from = $_smarty_tpl->tpl_vars['auth_infoA']->value;
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
              <tr style="border:1px solid gray"">
                   <td width="18%">
                   	<input type="checkbox" name="auth_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
" 
                      <?php if (in_array($_smarty_tpl->tpl_vars['v']->value['auth_id'],$_smarty_tpl->tpl_vars['have_authids']->value)) {?> checked="checked" <?php }?>
                   	/><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_name'];?>
</td>
                   <td>
                   	     <?php
$_from = $_smarty_tpl->tpl_vars['auth_infoB']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_1_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$__foreach_vv_1_saved_key = isset($_smarty_tpl->tpl_vars['kk']) ? $_smarty_tpl->tpl_vars['kk'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['vv']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
$_smarty_tpl->tpl_vars['vv']->_loop = true;
$__foreach_vv_1_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
                   	     <?php if ($_smarty_tpl->tpl_vars['vv']->value['auth_pid'] === $_smarty_tpl->tpl_vars['v']->value['auth_id']) {?>
                         <div style="width: 200px;float:left;">
                              <input type="checkbox" name="auth_id[]" value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_id'];?>
"
                              <?php if (in_array($_smarty_tpl->tpl_vars['vv']->value['auth_id'],$_smarty_tpl->tpl_vars['have_authids']->value)) {?> checked="checked" <?php }?>
                              /><?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_name'];?>

                         </div>
                         <?php }?>
                         <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_local_item;
}
if ($__foreach_vv_1_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_item;
}
if ($__foreach_vv_1_saved_key) {
$_smarty_tpl->tpl_vars['kk'] = $__foreach_vv_1_saved_key;
}
?>
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

          <div style="margin-top: 10px">
            <button class="button bg-main" type="submit" align="center">分配权限</button>
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
