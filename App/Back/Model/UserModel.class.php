<?php
/**
 * 后台bg_user表操作模型
 */
class UserModel extends Model {
	/**
	 * 获取所有用户信息
	 */
	public function getUser() {
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;  //偏移量
		//联表查询(bg_article所有字段、bg_category中cate_name字段、is_del是逻辑上删除的一个标志)
		$sql = "select * from bg_user order by user_time desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 获取用户的总记录数
	 */
	public function getRowCount() {
		$sql = "select count(*) from bg_user";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 添加用户入库
	 */
	public function insertUser($user) {
		// 通过数组得到多个变量
		extract($user);
		// 添加时间
		$addtime = time();
		// 入库
		$sql = "insert into bg_user values (null, '$user_name', '$user_pass', '$user_image', $addtime)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号获取用户信息
	 */
	public function getUserInfoById($user_id) {
		$sql = "select * from bg_user where user_id=$user_id";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 根据id号删除用户
	 */
	public function delUserById($user_id) {
		$sql = "delete from bg_user where user_id=$user_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 根据id号批量彻底删除用户
	 */
	public function DelAllUser($user_ids) {
		$sql = "delete from bg_user where user_id in($user_ids)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 更新用户状态
	 */
	public function updateTypeById($user_id, $is_type){
		if($is_type == '0') {
			$is_type = '1';
		}else {
			$is_type = '0';
		}
		$sql = "update bg_user set user_type = '$is_type' where user_id=$user_id";
		return $this->dao->my_query($sql);
	}
}