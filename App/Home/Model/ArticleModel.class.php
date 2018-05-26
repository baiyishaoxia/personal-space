<?php

/**
 * 前台bg_article表操作模型
 */
class ArticleModel extends Model {
	/**
	 * 获取推荐文件的列表 (联表查询) 【条件：a.cate_id=c.cate_id、没有被逻辑删除and已推荐】
	 */
	public function getRecommendArt($length) {
		$sql = "select a.*, c.cate_name from bg_article as a left join bg_category as c on a.cate_id=c.cate_id where a.is_del = '0' and is_recommend = '1' order by addtime desc limit $length";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取最新文章列表
	 */
	public function getNewArt($length) {
		// 只需要查询文章id和文章标题
		$sql = "select art_id, title from bg_article where is_del = '0' order by addtime desc limit $length";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取最热门推荐文章列表
	 */
	public function getRmdArtByHits($length) {
		// 只需要查询文章id和文章标题
		$sql = "select art_id, title from bg_article where is_del = '0' and is_recommend = '1' order by hits desc limit $length";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据类别号获取当前类别及其子类别下所有文章的信息【重点】
	 */
	public function getArtInfo($cate_id) {
		// 先获取该类别下所有的子类别的id号
		$ids = $this->getAllSubIds($cate_id);
		// 再拼凑当前分类的id号 (加上自己)
		$ids .= $cate_id;
		// 计算偏移量
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$HomeRowPage=$GLOBALS['conf']['Page']['HomeRowPage']; //每页显示数(前台)
		$offset = ($pageNum - 1) * $HomeRowPage;
		$sql = "select a.*, c.cate_name from bg_article as a left join bg_category as c on a.cate_id = c.cate_id where a.is_del='0' and a.cate_id in($ids) and c.is_del='0' order by addtime desc limit $offset,$HomeRowPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据当前分类号获取其所有的子分类号
	 */
	private function getAllSubIds($cate_id) {
		$sql = "select cate_id from bg_category where cate_pid = $cate_id";
		$id = $this->dao->fetchAll($sql);  //得到第一层
		static $ids = ''; //为递归做准备
		foreach($id as $row) {
			$ids .= $row['cate_id'] . ',';
			$this->getAllSubIds($row['cate_id']);
		}
		return $ids;
	}
	/**
	 * 获取当前分类及其子分类下所有文章的记录数
	 */
	public function getRowCount($cate_id) {
		// 先获取所有的子分类号
		$ids = $this->getAllSubIds($cate_id);
		// 再拼凑当前分类的id号
		$ids .= $cate_id;
		$sql = "select count(*) from bg_article where is_del='0' and cate_id in($ids)";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 获取面包屑导航数组信息
	 */
	public function getAllCateName($cate_id) {
		// 获取当前分类的名称和父类的id号
		$sql = "select cate_pid,cate_name from bg_category where cate_id=$cate_id";
		$cateInfo = $this->dao->fetchRow($sql);
		$cate_name = $cateInfo['cate_name'];
		static $list = array();
		$list[$cate_id] = $cate_name;
		$cate_pid = $cateInfo['cate_pid'];
		// 如果该类别的父类id不为0,递归点开始
		if($cate_pid != 0) {
			$this->getAllCateName($cate_pid);
		}
		return array_reverse($list, true); 
	}
	/**
	 * 获取该分类下文章点击排行 (根据点击率hits排序)
	 */
	public function getSortByHits($cate_id, $length) {
		// 先获取该分类下所有子分类的id号
		$ids = $this->getAllSubIds($cate_id);
		// 再拼凑当前分类的id号
		$ids .= $cate_id;
		$sql = "select art_id,title from bg_article where is_del = '0' and cate_id in($ids) order by hits desc limit $length";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取该分类下推荐文章排行
	 */
	public function getSortByRecommend($cate_id, $length) {
		// 先获取该分类下所有子分类的id号
		$ids = $this->getAllSubIds($cate_id);
		// 再拼凑当前分类的id号
		$ids .= $cate_id;
		$sql = "select art_id,title from bg_article where is_del = '0' and is_recommend = '1' and cate_id in($ids) order by addtime desc limit $length";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据id号获取文章的信息(当前文章所属分类的id的信息)
	 */	
	public function getArtInfoById($art_id) {
		$sql = "select * from bg_article where art_id=$art_id";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 更新当前文章的浏览器次数
	 */
	public function updateHitsById($art_id) {
		$sql = "update bg_article set hits = hits + 1 where art_id = $art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 获取该分类下上一篇文章信息
	 */
	public function getPrevArt($art_id, $cate_id) {
		// 先获取该分类下所有子分类的id号
		$son_ids = $this->getAllSubIds($cate_id);
		// 再获取该分类及其所有父类的id号
		$father_ids = $this->getAllCateName($cate_id);
		$father_ids = implode(',',array_keys($father_ids)); //取出单独的键(cate_id)
		$ids = $son_ids . $father_ids;
		$sql = "select art_id, title from bg_article where is_del = '0' and cate_id in($ids) and art_id < $art_id order by art_id desc limit 1";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 获取该分类下下一篇文章信息
	 */
	public function getNextArt($art_id, $cate_id) {
		// 先获取该分类下所有子分类的id号
		$son_ids = $this->getAllSubIds($cate_id);
		// 再获取该分类及其所有父类的id号
		$father_ids = $this->getAllCateName($cate_id);
		$father_ids = implode(',',array_keys($father_ids));
		$ids = $son_ids . $father_ids;
		$sql = "select art_id, title from bg_article where is_del = '0' and cate_id in($ids) and art_id > $art_id order by art_id limit 1";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 给当前文章的评论数加1
	 */
	public function updateReplyNumsById($art_id) {
		$sql = "update bg_article set reply_nums = reply_nums + 1 where art_id = $art_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 获取文章最新评论
	 */
	public function getSortByReply($length) {
		$sql = "select c.*,u.user_thumb from bg_comment as c left join bg_user as u on c.cmt_user = u.user_name where c.is_del='0' order by c.cmt_time desc limit $length";
		return $this->dao->fetchAll($sql);
	}

	//获取搜索的记录数
	public function getSumSearch($keyword) {
		$sql="select count(*) as sum from bg_article where title like '%{$keyword}%' or content like '%{$keyword}%'";
		return $this->dao->fetchColumn($sql);
	}
	//获取搜索的所有内容
	public function getContentSearch($keyword) {

		$sql="select *  from bg_article where title like '%{$keyword}%' or content like '%{$keyword}%'";
		return $sql;
		//var_dump($this->dao->fetchAll($sql));die;
	}
	public function getPageSearch($keyword) {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum-1)*$rowsPerPage;
		$sql="select *  from ({$this->getContentSearch($keyword)}) as a where is_del = '0' order by addtime limit $offset,$rowsPerPage";
		//echo $sql;die;
		return $this->dao->fetchAll($sql);
	}

	//获取banner表中的是否应用信息
	public function getBanner() {
		// 只需要查询banner标题和banner图像
		$sql = "select title,img from bg_banner where is_del = '0' and is_recommend = '1' order by addtime desc limit 1";
		return $this->dao->fetchRow($sql);
	}
}