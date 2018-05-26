<?php

/**
 * 基础模型类
 */
class Model {
	// 定义用来存储dao对象的属性,要求可以在子类中被访问
	protected $dao;
	/**
	 * 构造方法
	 */
	public function __construct() {
		// 初始化dao
		$this->initDAO();
	}
	/**
	 * 初始化dao
	 */
	protected function initDAO() {
		// 初始化dao
		$config = $GLOBALS['conf']['db'];
		// 根据配置文件,选择相应的数据库类文件
		switch($GLOBALS['conf']['App']['dao']) {
			case 'mysql' : $dao_class = 'MySQLDB';break;
			case 'pdo'   : $dao_class = 'PDODB';
		}
		$this->dao = $dao_class::getInstance($config);
	}
}