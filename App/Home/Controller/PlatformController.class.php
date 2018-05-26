<?php

/**
 * 前台平台控制器
 */
class PlatformController extends Controller {
	/**
	 * 构造方法
	 */
	public function __construct() {
		parent::__construct();
		$this->initFirstCateInfo();
		$this->initVars();
		$this->initSession();
	}
	public function initSession() {
		@session_start();
	}
	/**
	 * 分配导航条中的一级分类列表信息
	 */
	public function initFirstCateInfo() {
		// 调用Category模型
		$category = Factory::M('CategoryModel');
		// 获取所有一级分类信息
		$firstCate = $category->getFirstCate();
		// 分配变量
		$this->assign('firstCate', $firstCate);
	}
	/**
	 * 分配meta标签公共数据
	 */
	public function initVars() {
		$title = "白衣少侠个人空间";
		$keywords = "个人空间,白衣少侠,响应式";
		$description = "个人空间,白衣少侠,响应式，神秘、俏皮";
		// 分配变量
		$this->assign('title', $title);
		$this->assign('keywords', $keywords);
		$this->assign('description', $description);
	}
}
