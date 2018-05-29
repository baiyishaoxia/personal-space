<?php
/* Smarty version 3.1.29, created on 2018-03-12 16:45:45
  from "D:\php\BK\App\Back\View\Banner\edit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aa6aeb9a19a70_87391187',
  'file_dependency' => 
  array (
    '9b5ecb17564115590e24ca1c4bc8b2174420bc5c' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\Banner\\edit.html',
      1 => 1520871785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aa6aeb9a19a70_87391187 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../Public/public.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src='/App/Back/Public/ckeditor/ckeditor.js'>
//这里引入了在线编辑器
<?php echo '</script'; ?>
> 
<div class="admin">
  <div class="tab">
    <div class="tab-head"> <strong>Banner管理</strong>
      <ul class="tab-nav">
        <li class="active"><a href="#tab-set">修改Banner</a></li>
      </ul>
    </div>
    
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=Banner&a=dealEdit" enctype="multipart/form-data">

          <div class="form-group">
            <div class="label">
              <label for="logo">缩略图</label>
            </div>
            <div class="field"> 
              <img src="<?php echo @constant('BANNER_DIR');?>
/<?php echo $_smarty_tpl->tpl_vars['bannerInfoById']->value['img'];?>
" width="400px">
              <a class="button input-file" href="javascript:void(0);">上传文件
              <input size="100" type="file" name="banner"  />
              <input type="hidden" name="img" value="<?php echo $_smarty_tpl->tpl_vars['bannerInfoById']->value['img'];?>
">
			  <input type="hidden" name="picture" value="<?php echo $_smarty_tpl->tpl_vars['bannerInfoById']->value['picture'];?>
">
              </a> 
            </div>
          </div>
         
    
          <div class="form-group">
            <div class="label">
              <label for="readme">Banner标题内容</label>
            </div>
            <div class="field">
              <textarea name="title" id="ckeditor" class="input" rows="8" cols="50" ><?php echo $_smarty_tpl->tpl_vars['bannerInfoById']->value['title'];?>
</textarea>
              <?php echo '<script'; ?>
 type="text/javascript">
                CKEDITOR.replace('ckeditor',{
                                  uiColor: '#9400D3',//更改边框颜色
                                  width:500
                                });
              <?php echo '</script'; ?>
>
            </div>
          </div>
          <input type="hidden" name="banner_id" value="<?php echo $_smarty_tpl->tpl_vars['bannerInfoById']->value['id'];?>
">
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
