<?php
/* Smarty version 3.1.29, created on 2018-03-31 15:10:14
  from "/www/tzf.afu666.xyz/App/Home/View/Public/aside.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5abf3456d706a0_81792497',
  'file_dependency' => 
  array (
    'dfd80aad8e2211e514b3af776bac0781d5519aa1' => 
    array (
      0 => '/www/tzf.afu666.xyz/App/Home/View/Public/aside.html',
      1 => 1522337464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5abf3456d706a0_81792497 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/www/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) require_once '/www/tzf.afu666.xyz/Vendor/Smarty/plugins/modifier.date_format.php';
?>
  <aside>
    <div class="rnav">
    <?php
$_from = $_smarty_tpl->tpl_vars['subCate']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$__foreach_row_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
      <li class="rnav<?php echo $_smarty_tpl->tpl_vars['key']->value%4+1;?>
 "><a href="index.php?p=Home&c=Article&a=index&cate_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['cate_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['cate_name'];?>
</a></li>
    <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
if ($__foreach_row_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_row_0_saved_key;
}
?>
    </div>
    <div class="ph_news">
      <h2>
        <p>点击排行</p>
      </h2>
      <ul class="ph_n">
        <?php
$_from = $_smarty_tpl->tpl_vars['sortByHits']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_n1_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_n1']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_n1'] : false;
$__foreach_n1_1_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_n1'] = new Smarty_Variable(array('iteration' => 0));
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration']++;
$__foreach_n1_1_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
          <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration'] : null) <= 3) {?>
        <li><span class="num<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration'] : null);?>
"><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration'] : null);?>
</span><a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></li>
          <?php } else { ?>
          <li><span><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_n1']->value['iteration'] : null);?>
</span><a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></li>
          <?php }?>
        <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_n1_1_saved_local_item;
}
if ($__foreach_n1_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_n1'] = $__foreach_n1_1_saved;
}
if ($__foreach_n1_1_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_n1_1_saved_item;
}
?>
      </ul>
      <h2>
        <p>栏目推荐</p>
      </h2>
      <ul>
      <?php
$_from = $_smarty_tpl->tpl_vars['sortByRecommend']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_2_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_2_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
        <li><a href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></li>
      <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_local_item;
}
if ($__foreach_row_2_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_item;
}
?>
      </ul>
      <h2>
        <p>最新评论</p>
      </h2>
      <ul class="pl_n">
      <?php
$_from = $_smarty_tpl->tpl_vars['replyById']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_3_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_3_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
        <dl>
          <dt><img src="/Uploads/user/<?php echo $_smarty_tpl->tpl_vars['row']->value['user_thumb'];?>
"> </dt>
          <dt> </dt>
          <dd><?php echo $_smarty_tpl->tpl_vars['row']->value['cmt_user'];?>

            <time><?php echo $_smarty_tpl->tpl_vars['row']->value['format_date'];?>
</time> 
          </dd>
          <dd><a style="color:#666;" href="index.php?p=Home&c=Article&a=show&art_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['art_id'];?>
"><b><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['row']->value['cmt_content'],20,'...');?>
</b></a></dd>
        </dl>
      <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_3_saved_local_item;
}
if ($__foreach_row_3_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_3_saved_item;
}
?>
      </ul>
      <h2>
        <p>最近访客</p>
        <ul>
		 <?php
$_from = $_smarty_tpl->tpl_vars['laterUser']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_i_4_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_i']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_i'] : false;
$__foreach_i_4_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_i'] = new Smarty_Variable(array('iteration' => 0));
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration']++;
$__foreach_i_4_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
		     <?php if (((isset($_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['iteration'] : null)%6) > 5) {?>  <br><br><?php }?>
           <img src="/Uploads/user/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['row']->value['user_thumb'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['row']->value['user_image'] : $tmp);?>
" width="40" height="40" style="float:left;"> <!-- 直接使用“多说”插件的调用代码 -->
	     <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_i_4_saved_local_item;
}
if ($__foreach_i_4_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_i'] = $__foreach_i_4_saved;
}
if ($__foreach_i_4_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_i_4_saved_item;
}
?>
        </ul>
      </h2>
    </div>
    <div style="margin-top:130px"></div>
    <div class="copyright">
      <ul>
        <p> Design by <a href="/">白衣少侠</a></p>
        <p>湖南@备案@白衣工作室-1</p>
        <p>©CopyRight 2017-<?php echo smarty_modifier_date_format(time(),"%Y");?>
 白衣工作室  版权所有</p>
      </ul>
    </div>
    
  </aside><?php }
}
