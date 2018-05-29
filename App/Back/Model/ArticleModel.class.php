<?php

/**
 * 后台bg_article表操作模型
 */
class ArticleModel extends Model {
	/**
	 * 实现文章入库
	 */
	public function insertArt($art) {
		// 通过数组得到多个变量
		extract($art);
		// 完善其他数据表数据
		$addtime = time();
		// 入库
		$sql = "insert into bg_article values (null, $cate_id, '$title', '$thumb','$first_thumb','$art_desc', '$content', '$author', default, default, $addtime, default, default)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 获取所有文章信息
	 */
	public function getArticle() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;  //偏移量
		//联表查询(bg_article所有字段、bg_category中cate_name字段、is_del是逻辑上删除的一个标志)
		$sql = "select a.*,c.cate_name from bg_article as a left join bg_category as c on a.cate_id=c.cate_id where a.is_del='0' order by addtime desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据id号获取文章信息
	 */
	public function getArtInfoById($art_id) {
		$sql = "select * from bg_article where art_id=$art_id";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 根据id号修改文章信息
	 */
	public function UpdateArtById($art) {
		extract($art);
		$sql = "update bg_article set cate_id=$cate_id,title='$title',thumb='$thumb',first_thumb='$first_thumb',art_desc='$art_desc',author='$author',content='$content' where art_id=$art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号删除文章
	 */
	public function delArtById($art_id) {
		$sql = "update bg_article set is_del='1' where art_id=$art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量删除文章
	 */
	public function delAllArt($art_ids) {
		$sql = "update bg_article set is_del='1' where art_id in($art_ids)";
		return $this->dao->my_query($sql);
	}
    /**
	 * 根据id号一键还原文章
	 */
     public function restoreArt($art_ids) {
		 $sql = "update bg_article set is_del='0' where art_id in ($art_ids)";
		 return $this->dao->my_query($sql);
     }
	/**
	 * 获取所有已经逻辑删除了的文章信息
	 */
	public function getDelArt() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;
		$sql = "select a.*,c.cate_name from bg_article as a left join bg_category as c on a.cate_id=c.cate_id where a.is_del='1' order by addtime desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据id号还原文章 (将is_del='1'更改为 is_del='0' )
	 */
	public function recoverArtById($art_id) {
		$sql = "update bg_article set is_del='0' where art_id = $art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号彻底删除文章
	 */
	public function realDelArtById($art_id) {
		$sql = "delete from bg_article where art_id = $art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量彻底删除文章
	 */
	public function realDelAllArt($art_ids) {
		$sql = "delete from bg_article where art_id in($art_ids)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 获取文章的总记录数
	 */
	public function getRowCount() {
		$sql = "select count(*) from bg_article where is_del='0'";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 获取已经逻辑删除的文章的总记录数
	 */
	public function getDelRowCount() {
		$sql = "select count(*) from bg_article where is_del='1'";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 切换文章推荐状态
	 */
	public function updateRecommendById($art_id, $is_recommend) {
		if($is_recommend == '0') {
			$is_recommend = '1';
		}else {
			$is_recommend = '0';
		}
		$sql = "update bg_article set is_recommend = '$is_recommend' where art_id=$art_id";
		return $this->dao->my_query($sql);
	}
	/*
	*查询该文章下有多少文章属于同一个分类
	*/
	public function CountArtByCateId($cate_id) {
		$sql = "select count(*) from bg_article where cate_id='$cate_id'";
		return $this->dao->fetchColumn($sql);
	}
}
