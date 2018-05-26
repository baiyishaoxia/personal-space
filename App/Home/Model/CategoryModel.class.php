<?php

/**
 * 前台bg_category表操作模型
 */
class CategoryModel extends Model {
	/**
	 * 获取所有一级分类信息
	 */
	public function getFirstCate() {
		$sql = "select * from bg_category where cate_pid=0 and is_del='0' order by cate_sort limit 5";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取当前类别下的第一层子类别
	 */
	public function getSubCateByPid($pid) {
		$sql = "select cate_id, cate_name from bg_category where cate_pid=$pid and is_del='0'";
		return $this->dao->fetchAll($sql);
	}
	/**
	*获取文章所属分类(文章的所属分类$cate_id)
	*/
	public function getCateindex($cate_id) {
		 $sql="select * from bg_category where cate_id='$cate_id' ";
		 return $this->dao->my_query($sql);
	}
}