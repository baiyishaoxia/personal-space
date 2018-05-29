<?php

/**
 * 前台单页面控制器
 */
class SinglePageController extends PlatformController {
	/**
	 * 单页面首页动作
	 */
	public function indexAction() {
		// 获取单页面的id号
		$page_id = $_GET['page_id'];
		// 调用模型
		$singlePage = Factory::M('SinglePageModel');
		$pageInfo = $singlePage->getPageInfoById($page_id);
		// 分配变量
		$this->assign('pageInfo', $pageInfo);
		// 调用MasterModel获取站长信息
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		// 分配变量
		$this->assign('masterInfo', $masterInfo);
		// 输出视图
		$this->display('index.html');
	}
}