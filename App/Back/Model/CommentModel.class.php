<?php
/**
 * 后台bg_comment表操作模型
 */
class CommentModel extends Model {
	/**
	 * 获取所有评论信息
	 */
	public function getComment() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;  //偏移量
		//查询(bg_comment所有字段、is_del是逻辑上删除的一个标志)
		$sql = "select c.*,a.title from bg_comment as c left join bg_article as a on c.art_id=a.art_id where c.is_del='0' order by cmt_time desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取用户评论的总记录数
	 */
	public function getRowCount() {
		$sql = "select count(*) from bg_comment";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 根据id号删除文章 (逻辑删除)
	 */
	public function delCmtById($cmt_id) {
		$sql = "update bg_comment set is_del='1' where cmt_id=$cmt_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量删除文章
	 */
	public function delAllcmt($cmt_ids) {
		$sql = "update bg_comment set is_del='1' where cmt_id in($cmt_ids)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 获取所有已经逻辑删除了的评论信息
	 */
	public function getDelcmt() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;
		$sql = "select c.*,a.title from bg_comment as c left join bg_article as a on c.art_id=a.art_id where c.is_del='1' order by cmt_time desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取已经逻辑删除的评论的总记录数
	 */
	public function getDelRowCount() {
		$sql = "select count(*) from bg_comment where is_del='1'";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 根据id号还原评论 (将is_del='1'更改为 is_del='0' )
	 */
	public function recoverCmtById($cmt_id) {
		$sql = "update bg_comment set is_del='0' where cmt_id = $cmt_id";
		return $this->dao->my_query($sql);
	}
	 /**
	 * 根据id号一键还原评论
	 */
     public function restoreCmt($cmt_ids) {
		 $sql = "update bg_comment set is_del='0' where cmt_id in ($cmt_ids)";
		 return $this->dao->my_query($sql);
     }
	 /**
	 * 根据id号彻底删除评论
	 */
	public function realDelCmtById($cmt_id) {
		$sql = "delete from bg_comment where cmt_id = $cmt_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量彻底删除评论
	 */
	public function realDelAllCmt($cmt_ids) {
		$sql = "delete from bg_comment where cmt_id in($cmt_ids)";
		return $this->dao->my_query($sql);
	}
}