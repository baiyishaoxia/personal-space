<?php

/**
 * bg_comment表操作模型
 */

class CommentModel extends Model {
	/**
	 * 添加评论功能
	 */
	public function insertComment($cmtInfo) {
		extract($cmtInfo);
		$sql = "insert into bg_comment values(null, $art_id, '$cmt_user', '$cmt_content', $cmt_time,default)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据文章id号获取当前总评论数
	 */
	public function getRowCountById($art_id) {
		$sql = "select count(*) from bg_comment where art_id=$art_id and is_del='0'";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 根据文章id号获取当前页所有评论信息
	 */
	public function getCmtInfosById($art_id, $rowsPerPage) {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$offset = ($pageNum - 1) * $rowsPerPage;
		$sql = "select c.*, u.user_image from bg_comment as c left join bg_user as u on c.cmt_user = u.user_name where c.art_id = $art_id and is_del='0' order by c.cmt_time asc limit $offset, $rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
}