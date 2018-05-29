<?php

/**
 * 后台单页管理控制器
 */
class SinglePageController extends PlatformController {
	/**
	 * 单页管理首页动作
	 */
	public function indexAction() {
		// 需要提取所有的页面信息
		// 调用模型
		$singlePage = Factory::M('SinglePageModel');
		$pageInfo = $singlePage->getSinglePage();
		// 分配变量
		$this->assign('pageInfo', $pageInfo);
		// 输出视图文件
		$this->display('index.html');
	}
	/**
	 * 显示添加单页表单的动作
	 */
	public function addAction() {
		$this->display('add.html');
	}
	/**
	 * 处理单页面提交的数据
	 */
	public function dealAddAction() {
		// 接收表单
		$pageInfo = array();
		$pageInfo['title'] = $this->escapeData($_POST['title']);
		$pageInfo['content'] = addslashes($_POST['content']);
		// 判断数据的合法性
		if(empty($pageInfo['title']) || empty($pageInfo['content'])) {
			$this->jump('index.php?p=Back&c=SinglePage&a=add', ':( 您填写的信息不完整!');
		}
		// 调用模型,数据入库
		$singlePage = Factory::M('SinglePageModel');
		$result = $singlePage->insertPage($pageInfo);
		if($result) {
			$this->jump('index.php?p=Back&c=SinglePage&a=index');
		}else {
			$this->jump('index.php?p=Back&c=SinglePage&a=add', ':( 发生未知错误!添加失败!');
		}
	}

    /**
	 * 修改单页管理表单的动作
	 */

	public function editAction() {
		//输出权限信息
        $this->printAuth('page_id','SinglePage','index','修改','单页列表');
		// 获取当前单页管理的原始信息
		$page_id= $_GET['page_id'];
		// 实例化模型
		$Single = Factory::M('SinglePageModel');
		$SingleInfoById = $Single->getSingleInfoById($page_id); //(当前需要修改的信息)
		// 分配变量
		$this->assign('SingleInfoById', $SingleInfoById);
		// 显示视图文件
		$this->display('edit.html');
	}
	/**
	 * 处理修改单页管理信息动作
	 */
	public function dealEditAction() {
		// 接收表单数据
	    $page_id= $_GET['page_id'];
		$pageInfo = array();
		$pageInfo['title'] = $this->escapeData($_POST['title']);
		$pageInfo['content'] = addslashes($_POST['content']);
		// 判断数据是否合法
		if(empty($pageInfo['title']) || empty($pageInfo['content'])) {
			$this->jump("index.php?p=Back&c=SinglePage&a=edit&page_id={$page_id}", ':( 您填写的信息不完整!');
		}
		// 修改单页,需要调用模型
		$Single = Factory::M('SinglePageModel');
		// 调用updateCateById方法
		$result = $Single->updateSingleById($page_id,$pageInfo);  //修改(传递id)
		if($result) {
			// 成功修改,立即跳转到单页首页
			$this->jump('index.php?p=Back&c=SinglePage&a=index');
		}else {
			// 修改失败
			$this->jump('index.php?p=Back&c=SinglePage&a=index', '发生未知错误,修改单页信息失败！');
		}
	}

     /**
	 * 删除单页关于信息
	 */
	public function delAction() {
		//输出权限信息
        $this->printAuth('page_id','SinglePage','index','删除','单页列表');
		// 获取要删除的单页id号
		$page_id=$_GET['page_id'];
		// 实例化模型,执行删除操作
		$Single = Factory::M('SinglePageModel');
		$result = $Single->delSingleById($page_id);
		// 跳转
		if($result) {
			// 删除成功,跳转到分类首页
			$this->jump('index.php?p=Back&c=SinglePage&a=index');
		}else {
			// 删除失败
			$this->jump('index.php?p=Back&c=SinglePage&a=index', ':( 发生未知错误,删除失败!');
		}
	}
	/**
	 * 批量删除单页动作
	 */
	public function delAllAction() {

		// 先判断用户有没有选择
		if(!isset($_POST['single_id'])) {
			$this->jump('index.php?p=Back&c=SinglePage&a=index', '请先选择要删除的单页ID！');
		}
		// 接收需要删除的分类id号
		$single_id = $_POST['single_id'];//数组
		// 实例化模型,执行批量删除操作
		$single = Factory::M('SinglePageModel');
		$result = $single->delAllSingle($single_id);
		// 跳转
		if($result) {
			// 删除成功,跳转到分类首页
			$this->jump('index.php?p=Back&c=SinglePage&a=index');
		}else {
			// 删除失败
			$this->jump('index.php?p=Back&c=SinglePage&a=index', ':( 发生未知错误,删除失败!');
		}
	}
	

}