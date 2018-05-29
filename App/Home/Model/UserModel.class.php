<?php

/**
 * 前台bg_user表操作模型
 */
class UserModel extends Model {
     /*利用Ajax对注册信息进行实时刷新(已完善)**/
     public function checkregister_ajax($username){
     $user_name= $username;
     $sql = "select count(*) from bg_user where user_name = '$username'";
	 $info= $this->dao->fetchColumn($sql);
	 if($info == 0) {  //如果查询的记录为0
	       $info=0; // 说明用户名不存在
     }else {
	       $info=1;
     }
	 echo json_encode($info);  //查询成功返回0
     }


	/**
	 * 判断用户名是否已经存在
	 */
	public function if_name_exists($user_name) {
		$sql = "select * from bg_user where user_name = '$user_name'";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 注册信息入库
	 */
	public function insertUser($userInfo) {
		extract($userInfo);
		$sql = "insert into bg_user values(null, '$user_name', '$user_pass', '$user_image','$user_thumb',$user_time, unix_timestamp(),'$user_email',default)";
		return $this->dao->my_query($sql);
	}
	/**
	 * 判断用户的名称和密码是否合法
	 */
	public function check($user_name, $user_pass) {
		$sql = "select * from bg_user where user_name = '$user_name' and user_pass = '$user_pass'";
		return $this->dao->fetchRow($sql);
	}
	/**
	 * 判断用户是否被管理员拉黑
	 */
	public function blacklistUser($user_name){
		$sql = "select count(*) from bg_user where user_name = '$user_name' and user_type = '0'";
		return $this->dao->fetchColumn($sql);
	}
	/*判断用户是否存在*/
	public function checkName($user_name){
		$sql = "select count(*) from bg_user where user_name = '$user_name'";
		return $this->dao->fetchColumn($sql);
	}
	/**
	 * 更新当前用户的信息 【完善】
	 * @param $id 当前用户的id号
	 */
	public function updateUserInfo($id) {
		$login_time = time();
		$sql = "update bg_user set login_time=$login_time where user_id=$id";
		return $this->dao->my_query($sql);
	}
	/**
	*获取最近访客
	*/
	public function latervisiter() {
		$sql = "select * from bg_user order by login_time desc";
		return $this->dao->fetchAll($sql);
	}
	// 先提取旧头像名
	public function oldUserimage($user_name) {
		 $sql = "select user_image from bg_user where user_name='$user_name'";
		 return $this->dao->fetchColumn($sql);
	}
	// 入库,更新
	public function updateUserimage($userInfo) {
		 extract($userInfo);
		 $sql = "update bg_user set user_image='$user_image',user_thumb='$user_thumb' where user_name='$user_name'";
		 return $this->dao->my_query($sql);
	}
	//忘记密码修改用户信息
	public function checkModify($userInfo){
		 extract($userInfo);
		 $sql = "select count(*) from bg_user where user_name='$user_name' and user_email='$user_email'";
		 return $this->dao->fetchColumn($sql); 
	}
	//确认修改操纵
	public function modifyPassWord($password,$userInfo){
		extract($userInfo);
		$sql = "update bg_user set user_pass='$password' where user_name='$user_name' and user_email='$user_email'";
		return $this->dao->my_query($sql);
	}
        //用户详情信息
        public function usermessage($id){
              $sql = "select * from bg_user where user_id = '$id'";
	      return $this->dao->fetchRow($sql);
        }

}