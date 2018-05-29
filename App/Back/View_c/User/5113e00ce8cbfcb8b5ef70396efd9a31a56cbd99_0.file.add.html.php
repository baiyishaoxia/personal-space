<?php
/* Smarty version 3.1.29, created on 2017-08-17 12:52:13
  from "D:\php\BK\App\Back\View\User\add.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5995755db61819_34327260',
  'file_dependency' => 
  array (
    '5113e00ce8cbfcb8b5ef70396efd9a31a56cbd99' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\User\\add.html',
      1 => 1502967129,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5995755db61819_34327260 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>
//这里引入了在线编辑器
<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>用户管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">添加用户</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=User&a=dealAdd" enctype="multipart/form-data">
          <div class="form-group">
            <div class="label">
              <label for="sitename">用户名</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="user_name" size="50" placeholder="用户名" data-validate="required:请填写您的用户名" />
            </div>
          </div>
		    <div class="form-group">
            <div class="label">
              <label for="sitename">用户密码</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="title" name="user_pass" size="50" placeholder="用户密码" data-validate="required:请填写您的用户密码" />
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <label for="logo">用户头像</label>
            </div>
            <div class="field"> <a class="button input-file" href="javascript:void(0);">上传文件
              <input size="100" type="file" name="thumb"  /></a> 
			</div>
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
