<?php
/* Smarty version 3.1.29, created on 2018-03-28 22:21:02
  from "/www/wwwroot/tzf.afu666.xyz/App/Back/View/SinglePage/edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abba4ce14c400_92595595',
  'file_dependency' => 
  array (
    '817f61ab98f80929ffcb8c71d05669a792bc93c1' => 
    array (
      0 => '/www/wwwroot/tzf.afu666.xyz/App/Back/View/SinglePage/edit.html',
      1 => 1502867852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5abba4ce14c400_92595595 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>//引入在线编辑器<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>关于管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改单页</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=SinglePage&a=dealEdit&page_id=<?php echo $_smarty_tpl->tpl_vars['SingleInfoById']->value['page_id'];?>
">
          <div class="form-group">
            <div class="label">
              <label for="sitename">单页名称</label>
            </div>
            <div class="field">
              <input type="text" class="input" id="name" name="title" size="50" placeholder="分类名称" data-validate="required:请填写您的分类名称" value="<?php echo $_smarty_tpl->tpl_vars['SingleInfoById']->value['title'];?>
" />
            </div>
          </div>
 
          <div class="form-group">
            <div class="label">
              <label for="readme">个人描述</label>
            </div>
            <div class="field">
              <textarea name="content" id="ckeditor" rows="5" cols="50" ><?php echo $_smarty_tpl->tpl_vars['SingleInfoById']->value['content'];?>
</textarea>
			  <?php echo '<script'; ?>
 type="text/javascript">
                CKEDITOR.replace('ckeditor');
              <?php echo '</script'; ?>
>
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
