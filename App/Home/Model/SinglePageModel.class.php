<?php

/**
 * 前台bg_singlePage表操作模型
 */
class SinglePageModel extends Model {
	/**
	 * 根据id号获取单页面信息
	 */
	public function getPageInfoById($page_id) {
		$sql = "select * from bg_singlePage where page_id=$page_id";
		return $this->dao->fetchRow($sql);
	}
}
