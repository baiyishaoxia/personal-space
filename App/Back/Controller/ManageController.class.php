<?php

/**
 * 后台管理平台控制器
 */
class ManageController extends PlatformController {
	/**
	 * 首页动作
	 */
	public function indexAction() {
		// 实例化模型
		$model = Factory::M('MasterModel');
		/*会员*/
		$count=$model->userCount();
		$this->assign('count',$count);
		/*文章*/
		$article=$model->articleCount();
		$this->assign('article',$article);

		$this->display('index.html');
	}
}