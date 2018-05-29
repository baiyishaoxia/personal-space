<?php

/**
 * 后台bg_category分类表操作模型
 */
class CategoryModel extends Model {
    /*
	*获取所有资源
	*/
	public function getAllcate() {
		$sql = "select * from bg_category where is_del='0' order by cate_sort asc "; //根据cate_sort字段按升序
		return $this->dao->fetchAll($sql);
	}

	/**
	 * 获取分类信息 (树型结构)
	 */
	public function getCategory($pid=0) {
		$sql = "select * from bg_category order by cate_sort asc "; //根据cate_sort字段按升序
		$list = $this->dao->fetchAll($sql);
		return $this->getCateTree($list);  //调用格式化分类列表
	}

	/**
	 * 根据id号获取分类信息
	 * @param int $cate_id 当前分类的id号
	 * @return array 当前分类的信息
	 */
	public function getCateInfoById($cate_id) {
		$sql = "select * from bg_category where cate_id = $cate_id";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 格式化分类列表,重新排序并树状展示
	 * @param array $list 原始分类列表
	 * @param int $pid = 0 父类id号
	 * @param int $level 缩进级别
	 * @return array $cate_list 格式化之后的分类列表
	 */
	public function getCateTree($list, $pid=0, $level=0) {
		// 定义静态数组变量用于存放格式化之后的数组
		static $cate_list = array();
		// 遍历
		foreach($list as $row) {
			if($row['cate_pid'] == $pid) {
				$row['level'] = $level;
				$cate_list[] = $row;
				// 递归
				$this->getCateTree($list, $row['cate_id'], $level+1);
			}
		}
		// 返回遍历结果
		return $cate_list;
	}
	/**
	 * 增加分类信息
	 * @param array $cate 分类信息
	 */
	public function insertCate($cate) {
		// 通过数组得到多个变量 (炸开数组)
		extract($cate);
		$time=time();
		$sql = "insert into bg_category values(null,'$cate_name',$cate_pid,$cate_sort,'$cate_desc',default,$time)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号修改分类信息
	 * @param array $cate 分类信息
	 */
	public function updateCateById($cate) {
		// 通过数组得到多个变量
		extract($cate);
		$sql = "update bg_category set cate_name='$cate_name',cate_pid=$cate_pid,cate_sort=$cate_sort,cate_desc='$cate_desc'  where cate_id=$cate_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 删除指定的分类信息(单个逻辑删除)
	 */
	public function delCateById($cate_id) {
		$time=time();
		$sql = "update bg_category set is_del='1',del_time='$time' where cate_id = $cate_id";
		//$sql = "delete from bg_category where cate_id = $cate_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 批量删除分类信息 (批量删除为逻辑删除)
	 */
	public function delAllCate($cate_id) {
		// 此时$cate_id是一个数组,需要先转换为字符串
		$cate_ids = implode(',', $cate_id);
		$time=time();
		$sql = "update bg_category set is_del='1',del_time='$time' where cate_id in($cate_ids)";
		return $this->dao->my_query($sql);
	}
	/*
     * 判断一个节点是否是叶子节点
	 *@param return (没有返回真，有返回假)
     */
    public function isLeaf($cate_id){
        $sql="select count(*) from bg_category where cate_pid=$cate_id";
        return !$this->dao->fetchColumn($sql);
    }

	/**查询pid对应的分类信息*/
	public function find($cate_pid) {
		$sql="select cate_name from bg_category where cate_id=$cate_pid";
        return $this->dao->fetchRow($sql);
	}


	/**
	 * 获取所有已经逻辑删除了的分类信息
	 */
	public function getDelCate() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;
		$sql = "select * from bg_category where is_del='1' order by cate_sort desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取已经逻辑删除的分类的总记录数(用于分页)
	 */
	public function getDelRowCount() {
		$sql = "select count(*) from bg_category where is_del='1'";
		return $this->dao->fetchColumn($sql);
	}
	 /**
	 * 根据id号一键还原文章
	 */
     public function restoreCate($cate_ids) {
		 $sql = "update bg_category set is_del='0' where cate_id in ($cate_ids)";
		 return $this->dao->my_query($sql);
     }
	/**
	 * 根据id号批量彻底删除分类
	 */
	public function realDelAllCate($cate_ids) {
		$sql = "delete from bg_category where cate_id in($cate_ids)";
		return $this->dao->my_query($sql);
	}
}