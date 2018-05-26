<?php
/**
*友情链接控制器
*/	 
class FriendshipController extends PlatformController {
     /*
	 *显示友情链接信息
	 */
	 public function indexAction() {
		 //调用模型
		 $friend = Factory::M('FriendshipModel');
		 //获取信息
		 $friendInfo = $friend->getFriendInfo();
		 //分配变量
		 $this->assign('friendInfo',$friendInfo);
		 //输出视图
		 $this->display('index.html');
	 }
	 /**
	 * 显示添加友情链接表单的动作
	 */
	public function addAction() {
		// 输出视图文件
		$this->display('add.html');
	}
	/**
	 * 处理友情链接表单的动作
	 */
	public function dealAddAction() {
		// 接收表单
		$frd = array();
		$frd['frd_name'] = $this->escapeData($_POST['frd_name']);
		$frd['frd_url'] = $this->escapeData($_POST['frd_url']);
		// 判断数据合法性
		if(empty($frd['frd_name']) || empty($frd['frd_url'])) {
			$this->jump('index.php?p=Back&c=Friendship&a=add', ':( 您填写的数据不完整');
		}
		// 调用模型,数据入库
		$friend = Factory::M('FriendshipModel');
		$result = $friend->insertfrd($frd);
		if($result) {
			$this->jump('index.php?p=Back&c=Friendship&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Friendship&a=add', ':( 发生未知错误,添加链接失败！');
		}
	}
	/**
	 * 显示修改链接表单动作 
	 */
	public function editAction() {
		//输出权限信息
        $this->printAuth('frd_id','Friendship','index','修改','链接列表');
		// 接收链接的id号
		$frd_id = $_GET['frd_id'];
		// 获取当前文章的信息
		$friend = Factory::M('FriendshipModel');
		$frdInfoById = $friend->getfrdInfoById($frd_id);
		// 分配变量
		$this->assign('frdInfoById', $frdInfoById);
		// 输出视图文件
		$this->display('edit.html');
	}
	/**
	 * 处理修改链接表单表单的动作
	 */
	public function dealEditAction() {
		// 接收表单
		$frd = array();
		$frd['frd_id'] = $_POST['frd_id'];//从隐藏域中接收链接id号
		$frd['frd_name'] = $this->escapeData($_POST['frd_name']);
		$frd['frd_url'] = $this->escapeData($_POST['frd_url']);
		// 判断数据合法性
		if(empty($frd['frd_name']) || empty($frd['frd_url'])) {
			$this->jump('index.php?p=Back&c=Friendship&a=edit', ':( 您填写的数据不完整');
		}
		// 调用模型,数据入库
		$friend = Factory::M('FriendshipModel');
		$result = $friend->UpdatefrdById($frd);
		if($result) {
			$this->jump('index.php?p=Back&c=Friendship&a=index');
		}else {
			$this->jump("index.php?p=Back&c=Friendship&a=edit&frd_id={$frd['frd_id']}", ':( 发生未知错误,修改链接失败！');
		}
	}
	/**
	 * 根据id号删除链接
	 */
	public function delAction() {
		//输出权限信息
        $this->printAuth('frd_id','Friendship','index','删除','链接列表');
		// 要获取要删除的文章的id号
		$frd_id = $_GET['frd_id'];
		// 实例化模型
		$friend = Factory::M('FriendshipModel');
		$result = $friend->delArtById($frd_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Friendship&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Friendship&a=index', ':( 发生未知错误,删除链接失败！');
		}
	}
	/**
	 * 根据id号批量删除链接
	 */
	public function delAllAction() {

		// 先判断用户是否选择了链接
		if(!isset($_POST['frd_id'])) {
			// 说明没有没有选择链接
			$this->jump('index.php?p=Back&c=Friendship&a=index', ':( 请先选择要删除的链接！');
		}
		// 获取要删除的所有链接的id号
		$frd_ids = implode(',', $_POST['frd_id']); //以逗号分隔，把所有值连在一起
		// 调用模型
		$friend = Factory::M('FriendshipModel');
		$result = $friend->delAllArt($frd_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Friendship&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Friendship&a=index', ':( 发生未知错误,删除链接失败！');
		}
	}
}