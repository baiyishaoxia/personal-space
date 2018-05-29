<?php
/* Smarty version 3.1.29, created on 2018-03-12 14:22:27
  from "D:\php\BK\App\Back\View\Banner\add.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aa68d234f65e2_51120079',
  'file_dependency' => 
  array (
    '44bd54e3fdd5f34f4614600e3ad3ca644784c868' => 
    array (
      0 => 'D:\\php\\BK\\App\\Back\\View\\Banner\\add.html',
      1 => 1520863272,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/public.html' => 1,
  ),
),false)) {
function content_5aa68d234f65e2_51120079 ($_smarty_tpl) {
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
        <li class="active"><a href="#tab-set">添加Banner</a></li>
      </ul>
    </div>
    <div class="tab-body"> <br />
      <div class="tab-panel active" id="tab-set">
        <form method="POST" class="form-x" action="index.php?p=Back&c=Banner&a=dealAdd" enctype="multipart/form-data">

          <div class="form-group">
            <div class="label">
              <label for="logo">缩略图</label>
            </div>
            <div class="field"> <a class="button input-file" href="javascript:void(0);">上传文件
              <input size="100" type="file" name="banner"  />
              </a> 
            </div>
          </div>
         
    
          <div class="form-group">
            <div class="label">
              <label for="readme">Banner标题内容</label>
            </div>
            <div class="field">
              <textarea name="title" id="ckeditor" class="input" rows="8" cols="50" ></textarea>
              <?php echo '<script'; ?>
 type="text/javascript">
                CKEDITOR.replace('ckeditor',{
                                  uiColor: '#9400D3',//更改边框颜色
                                });
              <?php echo '</script'; ?>
>
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
