<?php
/*
*bg_friendship表的操作模型
*/
class FriendshipModel extends Model {
	/**
	*获取友情链接信息
	*/
	public function getFriendInfo() {
		$sql="select * from bg_friendship";
		return $this->dao->fetchAll($sql);
	}
	/*
	*添加链接入库
	*/
	public function insertfrd($frd) {
		// 通过数组得到多个变量
		extract($frd);
		// 入库
		$sql = "insert into bg_friendship values (null, '$frd_name','$frd_url')";
		return $this->dao->my_query($sql);
	}
	 /**
	 * 根据id号获取链接信息
	 */
	public function getfrdInfoById($frd_id) {
		$sql="select * from bg_friendship where frd_id=$frd_id ";
		return $this->dao->fetchRow($sql);
	}
    /**
	 * 根据id号修改链接信息
	 */
	public function UpdatefrdById($frd) {
		extract($frd);
		$sql="update bg_friendship set frd_name='$frd_name',frd_url='$frd_url' where frd_id=$frd_id";
		return $this->dao->my_query($sql);
	}
    /**
	 * 根据id号删除文章
	 */
	public function delArtById($frd_id) {
		$sql = "delete from bg_friendship where frd_id = $frd_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量彻底删除文章
	 */
	public function delAllArt($frd_ids) {
		$sql = "delete from bg_friendship where frd_id in($frd_ids)";
		return $this->dao->my_query($sql);
	}
	
	

}	 