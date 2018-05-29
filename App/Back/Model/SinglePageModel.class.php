<?php

/**
 * 后台bg_singlePage表操作模型
 */
class SinglePageModel extends Model {
	/**
	 * 获取所有的单页面信息
	 */
	public function getSinglePage() {
		$sql = "select * from bg_singlePage order by page_id desc";
		return $this->dao->fetchAll($sql);
	}
     /**
	 * 根据id号获取单页信息
	 */
	public function getSingleInfoById($single_id) {
		$sql = "select * from bg_singlePage where page_id = $single_id";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 单页面入库
	 */
	public function insertPage($pageInfo) {
		extract($pageInfo);
		// 入库
		$sql = "insert into bg_singlePage values(null, '$title', '$content')";
		return $this->dao->my_query($sql);
	}
    /**
	 * 单页面修改
	 */
    public function updateSingleById($id,$pageInfo) {
		// 接收表单数据
	    $page_id= $id;
        extract($pageInfo);
		//拼写SQL语句
		$sql = "update bg_singlePage set title='$title',content='$content' where page_id=$page_id";
		return $this->dao->my_query($sql);
    }

	/*
	*删除指定的单页id
	*/
	public function delSingleById($page_id) {
		$sql = "delete from bg_singlePage where page_id = $page_id";
		return $this->dao->my_query($sql);
		
	}

	/**
	 * 批量删除单页信息
	 */
	public function delAllSingle($single_id) {
		// 此时$single_id是一个数组,需要先转换为字符串
		$page_id = implode(',', $single_id);
		$sql = "delete from bg_singlePage where page_id in($page_id)";
		return $this->dao->my_query($sql);
	}
}
