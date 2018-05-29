<?php
/* Smarty version 3.1.29, created on 2017-08-15 15:10:39
  from "D:\php\BK\App\Back\View\Friendship\edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5992f2cf8d8c85_42673389',
  'file_dependency' => 
  array (
    '269a51876992b57bee4141ea518f9b8093b1219d' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\Friendship\\edit.html',
      1 => 1502802376,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5992f2cf8d8c85_42673389 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'><?php echo '</script'; ?>
>
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>链接管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改链接</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=Friendship&a=dealEdit" enctype="multipart/form-data">
          <div class="form-group">
            <div class="label">
              <label for="sitename">链接标题</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="frd_name" name="frd_name" size="50" placeholder="链接标题" data-validate="required:请填写您的链接标题" value="<?php echo $_smarty_tpl->tpl_vars['frdInfoById']->value['frd_name'];?>
" />
            </div>
          </div>
          
          <div class="form-group">
            <div class="label">
              <label for="siteurl">链接URL</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="frd_url" name="frd_url" size="50" placeholder="请填写链接地址" data-validate="required:请填写链接地址" value="<?php echo $_smarty_tpl->tpl_vars['frdInfoById']->value['frd_url'];?>
" />
            </div>
          </div>
          
          <div class="form-button">
            <input type="hidden" name="frd_id" value="<?php echo $_smarty_tpl->tpl_vars['frdInfoById']->value['frd_id'];?>
">
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
