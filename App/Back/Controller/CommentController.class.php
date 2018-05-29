<?php
/**
 * 评论管理控制器
 */
class CommentController extends PlatformController {
	/**
	 * 评论管理首页动作
	 */
	public function indexAction() {
		// 实例化模型,提取所有的评论信息
		$cmt = Factory::M('CommentModel');
		$cmtInfo = $cmt->getComment();
		// 分配变量
		$this->assign('cmtInfo', $cmtInfo);
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage']; //每页记录数
		$maxNum = $GLOBALS['conf']['Page']['maxNum']; //最大页码个数
		$url = "index.php?p=Back&c=Comment&a=index&";
		$rowCount = $cmt->getRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分页到此结束
		// 输出视图文件
		$this->display('index.html');
	}
	/**
	 * 根据id号删除评论
	 */
	public function delAction() {
		//输出权限信息
        $this->printAuth('cmt_id','Comment','index','id号删除','评论列表');
		// 要获取要删除的文章的id号
		$cmt_id = $_GET['cmt_id'];
		// 实例化模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->delCmtById($cmt_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Comment&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=index', ':( 发生未知错误,删除评论失败！');
		}
	}
	/**
	 * 根据id号批量删除评论
	 */
	public function delAllAction() {

		// 先判断用户是否选择了文章
		if(!isset($_POST['cmt_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Comment&a=index', ':( 请先选择要删除的评论！');
		}
		// 获取要删除的所有评论的id号
		$cmt_ids = implode(',', $_POST['cmt_id']); //以逗号分隔，把所有值连在一起
		// 调用模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->delAllcmt($cmt_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Comment&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=index', ':( 发生未知错误,删除评论失败！');
		}
	}
	/**
	 * 显示黑评论信息动作 
	 */
	public function recycleAction() {
		// 调用模型,提取所有已经被逻辑删除的文章信息
		$cmt = Factory::M('CommentModel');
		$cmtInfo = $cmt->getDelcmt();
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = "index.php?p=Back&c=Comment&a=recycle&";
		$rowCount = $cmt->getDelRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分配变量
		$this->assign('cmtInfo', $cmtInfo);
		// 输出视图文件
		$this->display('recycle.html');
	}
    /**
	 * 根据id号实现评论还原动作
	 */
	public function recoverAction() {
		//输出权限信息
        $this->printAuth('cmt_id','Comment','recycle','id号还原','黑评论');
		// 获取需要还原的文章的id号
		$cmt_id = $_GET['cmt_id'];
		// 调用模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->recoverCmtById($cmt_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Comment&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=recycle', ':( 发生未知错误,还原评论失败！');
		}
	}
	/*
	*根据id号实现一键还原
	*/
	public function restoreAction() {

		//先判断用户是否选择了评论
		if(!isset($_POST['cmt_id'])) {
		   //说明没有选择文章
		   $this->jump('index.php?p=Back&c=Comment&a=recycle',':( 请您选择需要还原的评论！');
		}
		//获取要还原的所有评论id号
		$cmt_ids = implode(',',$_POST['cmt_id']);
		//调用模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->restoreCmt($cmt_ids);
		if($result){
		    $this->jump('index.php?p=Back&c=Comment&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=recycle',':( 一键还原评论失败！');
		}	
	}
	/**
	 * 根据id号实现彻底删除评论动作
	 */
	public function realDelAction() {
		//输出权限信息
        $this->printAuth('cmt_id','Comment','recycle','id号彻底删除','黑评论');
		// 要获取要删除的评论的id号
		$cmt_id = $_GET['cmt_id'];
		// 实例化模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->realDelCmtById($cmt_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Comment&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=recycle', ':( 发生未知错误,彻底删除评论失败！');
		}
	}
	/**
	 * 根据id号实现批量彻底删除评论动作
	 */
	public function realDelAllAction() {

		// 先判断用户是否选择了评论
		if(!isset($_POST['cmt_id'])) {
			// 说明没有没有选择评论
			$this->jump('index.php?p=Back&c=Comment&a=recycle', ':( 请先选择要删除的评论！');
		}
		// 获取要彻底删除的所有评论的id号
		$cmt_ids = implode(',', $_POST['cmt_id']);
		// 调用模型
		$cmt = Factory::M('CommentModel');
		$result = $cmt->realDelAllCmt($cmt_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Comment&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Comment&a=recycle', ':( 发生未知错误,彻底删除评论失败！');
		}
	}
}