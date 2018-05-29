<?php

/**
 * 后台分类管理控制器
 */
class CategoryController extends PlatformController {
	/**
	 * 显示分类管理首页动作
	 */
	public function indexAction() {
		// 实例化模型
		$category = Factory::M('CategoryModel');
		// 获取所有的分类信息(调用已经格式化的树状结果集)
		//$cateInfo = $category->getCategory();
		$cateInfo = $category->getAllcate();

		//二次遍历查询顶级部门
		foreach ($cateInfo as $key => $value) {
			if($value['cate_pid'] > 0){
				//查询cate_pid对应的分类信息
				$info = $category -> find($value['cate_pid']);
				//只需要保留其中的name
				//var_dump($value);die;
				$cateInfo[$key]['catename'] = $info['cate_name'];
			}
		}
		$cateInfo = $category->getCateTree($cateInfo);
		//var_dump($cateInfo);die;

		// 分配变量到视图文件
		$this->assign('cateInfo', $cateInfo);
		// 显示输出视图文件
		$this->display('index.html');
	}
	/**
	 * 显示添加分类表单动作
	 */
	public function addAction() {
		// 提取分类信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		// 分配变量到视图文件
		$this->assign('cateInfo', $cateInfo);
		// 显示输出视图文件
		$this->display('add.html');
	}
	/**
	 * 处理提交的分类表单
	 */
	public function dealAddAction() {
		// 接收表单数据
		$cate = array();
		$cate['cate_name'] = $this->escapeData($_POST['cate_name']);
		$cate['cate_pid'] = $_POST['cate_pid'];
		$cate['cate_sort'] = $this->escapeData($_POST['cate_sort']);
		$cate['cate_desc'] = $this->escapeData($_POST['cate_desc']);
		// 判断数据是否合法
		if(empty($cate['cate_name']) || empty($cate['cate_sort']) || empty($cate['cate_desc'])) {
			$this->jump('index.php?p=Back&c=Category&a=add', ':( 您填写的信息不完整!');
		}
		if(!is_numeric($cate['cate_sort']) || (int)($cate['cate_sort']) != $cate['cate_sort'] || $cate['cate_sort'] < 1) {
			$this->jump('index.php?p=Back&c=Category&a=add', ':( 排序编号为1-50');
		}
		// 数据入库,需要调用模型
		$category = Factory::M('CategoryModel');
		// 调用insertCate方法
		$result = $category->insertCate($cate);
		if($result) {
			// 成功入库,立即跳转到分类首页
			$this->jump('index.php?p=Back&c=Category&a=index',':)添加分类成功！');
		}else {
			// 入库失败
			$this->jump('index.php?p=Back&c=Category&a=add', ':(发生未知错误,添加分类失败！');
		}
	}
	/**
	 * 修改分类信息动作
	 */
	public function editAction() {
		//输出权限信息
        $this->printAuth('cate_id','Category','index','修改','分类列表');
		// 获取当前分类的原始信息
		$cate_id = $_GET['cate_id'];
		// 实例化模型
		$category = Factory::M('CategoryModel');
		$cateInfoById = $category->getCateInfoById($cate_id); //(当前需要修改的信息)
		// 分配变量
		$this->assign('cateInfoById', $cateInfoById);
		// 页面中要显示所有的分类,所以也需要提取所有分类信息 (提取所属下拉分类信息)
		$cateInfo = $category->getCategory();
		// 分配变量
		$this->assign('cateInfo', $cateInfo);
		// 显示视图文件
		$this->display('edit.html');
	}
	/**
	 * 处理修改分类信息动作
	 */
	public function dealEditAction() {
		// 接收表单数据
		$cate = array();
		$cate['cate_name'] = $this->escapeData($_POST['cate_name']);
		$cate['cate_pid'] = $_POST['cate_pid'];
		$cate['cate_sort'] = $this->escapeData($_POST['cate_sort']);
		$cate['cate_desc'] = $this->escapeData($_POST['cate_desc']);
		$cate['cate_id'] = $_POST['cate_id'];//从隐藏域中接收当前分类的id号

		//自己不能是自己的子级 (重点)
		if($cate['cate_id']==$cate['cate_pid']){
			$this->jump('index.php?p=Back&c=Category&a=index', ':( 自己不能是自己的子级', 3);
			exit;
		}
		//指定的父级不能是自己的后代
		$category = Factory::M('CategoryModel');
		$sublist=$category->getCategory($cate['cate_id']);  //当前节点下的所有子元素
		foreach($sublist as $rows){
			if($rows['cate_id']==$cate['cate_pid']){
				$this->jump('index.php?p=Back&c=Category&a=index', ':( 指定的父级不能是自己的后代');
				exit;
			}
		}

		// 判断数据是否合法
		if(empty($cate['cate_name']) || empty($cate['cate_sort']) || empty($cate['cate_desc'])) {
			$this->jump("index.php?p=Back&c=Category&a=edit&cate_id={$cate['cate_id']}", ':( 您填写的信息不完整!');
		}
		if(!is_numeric($cate['cate_sort']) || (int)($cate['cate_sort']) != $cate['cate_sort'] || $cate['cate_sort'] < 1) {
			$this->jump("index.php?p=Back&c=Category&a=edit&cate_id={$cate['cate_id']}", ':( 排序编号为1-50');
		}
		// 修改分类,需要调用模型
		$category = Factory::M('CategoryModel');
		// 调用updateCateById方法
		$result = $category->updateCateById($cate);
		if($result) {
			// 成功修改,立即跳转到分类首页
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else {
			// 修改失败
			$this->jump('index.php?p=Back&c=Category&a=index', ':( 发生未知错误,修改分类失败！');
		}
	}


	/**
	 * 删除单个分类动作
	 */
	public function delAction() {
		//输出操作权限信息
		$this->printAuth('cate_id','Category','index','删除','分类列表');
		// 获取要删除的分类的id号
		$cate_id = $_GET['cate_id'];
		// 实例化模型,执行删除操作
		$category = Factory::M('CategoryModel');
		if($category->isLeaf($cate_id)){
			    $art=Factory::M('ArticleModel');
				$art_count=$art->CountArtByCateId($cate_id); //查询同一个分类下有多少文章
				if($art_count > 1){
				     $this->jump('index.php?p=Back&c=Category&a=index', ':( 该分类下有若干文章,请到文章管理中查看后删除!');
				}else{
						$result = $category->delCateById($cate_id);
						// 跳转
						if($result) {
							// 删除成功,跳转到分类首页
							$this->jump('index.php?p=Back&c=Category&a=index');
						}else {
							// 删除失败
							$this->jump('index.php?p=Back&c=Category&a=index', ':( 发生未知错误,删除失败!');
						}
				}
				
	 }else{
		    //说明含有子节点
		    $this->jump('index.php?p=Back&c=Category&a=index', ':( 此节点下有节点，不允许删除');
	      }
	}
	/**
	 * 批量删除分类动作
	 */
	public function delAllAction() {
		// 先判断用户有没有选择
		if(!isset($_POST['cate_id'])) {
			$this->jump('index.php?p=Back&c=Category&a=index', ':( 请先选择要删除的分类！');
		}
		// 接收需要删除的分类id号
		$cate_id = $_POST['cate_id'];//数组
		// 实例化模型,执行批量删除操作
		$category = Factory::M('CategoryModel');
		$result = $category->delAllCate($cate_id);
		// 跳转
		if($result) {
			// 删除成功,跳转到分类首页
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else {
			// 删除失败
			$this->jump('index.php?p=Back&c=Category&a=index', ':( 发生未知错误,删除失败!');
		}
	}

	/**
	 * 显示回收站信息动作 
	 */
	public function recycleAction() {
		// 调用模型,提取所有已经被逻辑删除的文章信息
		$cate = Factory::M('CategoryModel');
		$cateInfo = $cate->getDelCate();
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = "index.php?p=Back&c=Category&a=recycle&";
		$rowCount = $cate->getDelRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分配变量
		$this->assign('cateInfo', $cateInfo);
		// 输出视图文件
		$this->display('recycle.html');
	}

	/*
	*根据id号实现一键还原
	*/
	public function restoreAction() {
		//先判断用户是否选择了文章
		if(!isset($_POST['cate_id'])) {
		   //说明没有选择文章
		   $this->jump('index.php?p=Back&c=Category&a=recycle',':( 请您选择需要还原的类别！');
		}
		//获取要还原的所有文章id号
		$cate_ids = implode(',',$_POST['cate_id']);
		//调用模型
		$category = Factory::M('CategoryModel');
		$result = $category->restoreCate($cate_ids);
		if($result){
		    $this->jump('index.php?p=Back&c=Category&a=recycle',':) 恭喜您，一键还原成功！');
		}else {
			$this->jump('index.php?p=Back&c=Category&a=recycle',':( 一键还原文章失败！');
		}
	}
	/**
	 * 根据id号实现批量彻底删除分类动作
	 */
	public function realDelAllAction() {
		//输出操作权限信息
		$this->printAuth('cate_id','Category','recycle','批量彻底删除','回收站列表');
		// 先判断用户是否选择了文章
		if(!isset($_POST['cate_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Category&a=recycle', ':( 请先选择要删除的分类！');
		}
		// 获取要彻底删除的所有文章的id号
		$cate_ids = implode(',', $_POST['cate_id']);
		// 调用模型
		$category = Factory::M('CategoryModel');
		//原图的信息
		$result = $category->realDelAllCate($cate_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Category&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Category&a=recycle', ':( 发生未知错误,彻底删除分类失败！');
		}
	}
}