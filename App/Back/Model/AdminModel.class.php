<?php

/**
 * 后台bg_admin表操作模型
 */
class AdminModel extends Model {
	/**
	 * 验证管理员的合法性
	 */
	public function check($admin_name, $admin_pass) {
		$sql = "select * from bg_admin where admin_name='$admin_name' and admin_pass=md5('$admin_pass')";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 更新当前管理员的信息
	 * @param $id 当前管理员id号
	 */
	public function updateAdminInfo($id) {
		$login_ip = $_SERVER["REMOTE_ADDR"];
		$login_time = time();
		$sql = "update bg_admin set login_ip='$login_ip', login_time=$login_time,login_nums=login_nums+1 where admin_id=$id";
		return $this->dao->my_query($sql);
	}
}