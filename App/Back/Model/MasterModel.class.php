<?php

/**
 * bg_master表操作模型
 */
class MasterModel extends Model {
	/**
	 * 获取站长信息
	 */
	public function getMasterInfo() {
		$sql = "select * from bg_master limit 1";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 更新站长信息
	 */
	public function updateMasterInfo($masterInfo) {
		extract($masterInfo);
		$sql = "update bg_master set nickname='$nickname', job='$job', tel='$tel', home='$home',email='$email',aboutname='$aboutname',signature='$signature',headerthumb='$headerthumb'";
		return $this->dao->my_query($sql);
	}


	/**
	*站点统计
	*会员
	*/
	public function userCount() {
	 $sql = "select count(*) as count from bg_user";
     return $this->dao->fetchColumn($sql);
	}
	/*
	*文章
	*/
	public function articleCount() {
	 $sql = "select count(*) as count from bg_article where is_del='0'";
     return $this->dao->fetchColumn($sql);
	}
}