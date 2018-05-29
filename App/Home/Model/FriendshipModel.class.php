<?php

/**
 * bg_friendship表操作模型
 */
class FriendshipModel extends Model {
	/**
	 * 获取友情链接信息
	 */
	public function getfrdInfo(){
		$sql = "select * from bg_friendship";
		return $this->dao->fetchAll($sql);
	}
}	 
