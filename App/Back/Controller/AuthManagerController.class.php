<?php

/**
 * 后台权限控制器(管理员、角色、权限列表等)
 */
class AuthManagerController extends PlatformController {
	/**
	 * 管理员首页动作
	 */
	public function indexAction() {
		// 需要提取所有的页面信息
		// 调用模型
		$admin = Factory::M('AuthManagerModel');
		$AdminInfo = $admin->getAdminInfo();
		// 分配变量
		$this->assign('AdminInfo', $AdminInfo);
		// 输出视图文件
		$this->display('index.html');
	}
	/**
	 * 显示添加管理员
	 */
	public function addAdminAction(){
		// 提取角色信息
		$role = Factory::M('AuthManagerModel');
		$adminInfo = $role->getRoleManage();
        $this->assign('adminInfo',$adminInfo);
		$this->display('admin_add.html');
	}
	/**
	 * 添加管理员处理动作
	 */
	public function dealAddAdminAction(){
		// 接收表单数据
		$admin = array();
		$admin['admin_name'] = $this->escapeData($_POST['admin_name']);
		$admin['ad_role_id'] = $_POST['ad_role_id'];
		$admin_pass1 = trim($_POST['pass1']);
		$admin_pass2 = trim($_POST['pass2']);
		// 判断数据是否合法
		if(empty($admin['admin_name']) || empty($admin_pass1) || empty($admin_pass2)) {
			$this->jump('index.php?p=Back&c=AuthManager&a=addAdmin', ':( 您填写的信息不完整!');
		}
		// 判断密码是否一致
		if(empty($admin_pass1) || empty($admin_pass2)) {
			$this->jump('index.php?p=Back&c=AuthManager&a=addAdmin', ':( 密码不能为空！');
		}
		if($admin_pass1 !== $admin_pass2) {
			$this->jump('index.php?p=Back&c=AuthManager&a=addAdmin', ':( 两次密码不一致！');
		}
		$admin['admin_pass'] = md5($admin_pass1);
        
		// 数据入库,需要调用模型
		$ad = Factory::M('AuthManagerModel');
		// 调用insertCate方法
		$result = $ad->insertAdmin($admin);
		if($result) {
			// 成功入库,立即跳转到分类首页
			$this->jump('index.php?p=Back&c=AuthManager&a=index',':)添加管理员成功！');
		}else {
			// 入库失败
			$this->jump('index.php?p=Back&c=AuthManager&a=addAdmin', ':(发生未知错误,添加管理员失败！');
		}
	}
	/**
	 * 显示管理员的修改
	 */
	public function editAdminAction(){
		//输出权限信息
        $this->printAuth('admin_id','AuthManager','index','修改','管理员列表');
		$admin_id = $_GET['admin_id'];
		// 调用模型
        $admin = Factory::M('AuthManagerModel');
        $adminInfo = $admin->getAdminInfobyId($admin_id);
        $RoleInfo = $admin->getRoleInfo();
        $this->assign('adminInfo',$adminInfo);
        $this->assign('RoleInfo',$RoleInfo);
		$this->display('admin_edit.html');
	}
	/**
	 * 处理管理员修改动作
	 */
	public function dealEditAdminAction(){
		//输出权限信息
        $this->printAuth('admin_id','AuthManager','index','管理员修改','权限管理');
		$admin_id = $_GET['admin_id'];
		// 接收表单数据
		$admin = array();
		$admin['admin_name'] = $this->escapeData($_POST['admin_name']);
		$admin['ad_role_id'] = $_POST['ad_role_id'];
		$admin_pass = trim($_POST['admin_pass']);
		$admin['admin_pass'] = md5($admin_pass);
		// 调用模型
        $ad = Factory::M('AuthManagerModel');
        $result = $ad->updateAdminInfo($admin,$admin_id);
        if($result){
        	$this->jump('index.php?p=Back&c=AuthManager&a=index', ':) 恭喜你，修改管理员成功！');
        }else{
        	$this->jump("index.php?p=Back&c=AuthManager&a=editAdmin&admin_id='$admin_id', ':( 发生未知错误，修改管理员失败！");
        }
	}

	/**
	 * 角色管理动作
	 */
	public function roleAction() {
		// 调用模型
        $role = Factory::M('AuthManagerModel');
        $roleInfo = $role->getRoleInfo();

		// 分配变量
        $this->assign('roleInfo',$roleInfo);
		// 输出视图文件
		$this->display('role_index.html');
	}
	/**
	 * 显示角色添加
	 */
	public function addRoleAction(){

		$this->display('role_add.html');
	}

	/**
	 * 显示角色修改
	 */
	public function editRoleAction(){
		//输出权限信息
        $this->printAuth('role_id','AuthManager','role','修改','角色管理');
		$role_id = $_GET['role_id'];
		// 调用模型
        $role = Factory::M('AuthManagerModel');
        $roleInfo = $role->getRoleIdInfo($role_id);
        $this->assign('roleInfo',$roleInfo);
		$this->display('role_edit.html');
	}
	/**
	 * 管理员删除
	 */
	public function delAdminAction(){
		//输出权限信息
        $this->printAuth('admin_id','AuthManager','index','管理员删除','权限管理');
		$admin_id = $_GET['admin_id'];
		$admin = Factory::M('AuthManagerModel');
		$result = $admin->deleteAdmin($admin_id);
		if($result){
			$this->jump("index.php?p=Back&c=AuthManager&a=index", ':)恭喜你，删除成功！');
		}else{
			$this->jump("index.php?p=Back&c=AuthManager&a=index", ':(发生未知错误，删除失败！');
		}
	}

	/**
	 * 角色删除
	 */
	public function delRoleAction(){
		$role_id = $_GET['role_id'];
		$this->jump('index.php?p=Back&c=AuthManager&a=role', ':( 管理员觉得此处毫无意义，暂未开放！');
	}
	/**
	 * 角色回收站
	 */
	public function recycleRoleAction(){
		$this->jump('index.php?p=Back&c=AuthManager&a=role', ':( 管理员觉得此处毫无意义，暂未开放！');
	}
	/**
	 * 权限列表回收站
	 */
	public function recycleAuthAction(){
		$this->jump('index.php?p=Back&c=AuthManager&a=authList', ':( 管理员觉得此处毫无意义，暂未开放！');
	}
	/**
	 * 添加角色动作
	 */
	public function dealAddRoleAction(){
		// 先判断用户是否提交有数据
		if(!isset($_POST['role_name'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=AuthManager&a=AddRole', ':( 请先填写添加的角色！');
		}

		 $role_name = $_POST['role_name'];
		// 调用模型
        $role = Factory::M('AuthManagerModel');
        $result = $role->addRole($role_name);
        if($result){
        	$this->jump('index.php?p=Back&c=AuthManager&a=role', ':) 恭喜你，添加角色成功！');
        }else{
        	$this->jump('index.php?p=Back&c=AuthManager&a=role', ':( 发生未知错误，更改角色失败！');
        }
	}
	/**
	 * 角色修改动作
	 */
	public function dealEditRoleAction(){
		 //输出权限信息
         $this->printAuth('role_id','AuthManager','role','角色处理修改','角色管理');
		 $role_id = $_GET['role_id'];
		 $role_name = $_POST['role_name'];
		// 调用模型
        $role = Factory::M('AuthManagerModel');
        $result = $role->updateRole($role_id,$role_name);
        if($result){
        	$this->jump('index.php?p=Back&c=AuthManager&a=role', ':) 恭喜你，更改名称成功！');
        }else{
        	$this->jump('index.php?p=Back&c=AuthManager&a=role', ':( 发生未知错误，更改名称失败！');
        }

	}
	/**
	 * 为角色分配权限
	 */
	public function distributeAction(){
        
		$role = Factory::M('AuthManagerModel');
        if(!empty($_POST)){
        	$role_id = $_POST['role_id'];
           //var_dump($_POST); //role_id、auth_ids(array)
           //收集好设置的权限，并制作为数据表要求格式，并存储
           $result = $role->saveAuth($_POST['role_id'],$_POST['auth_id']);
           if($result){
           	  $this->jump('index.php?p=Back&c=AuthManager&a=role', ':) 恭喜你，权限分配成功！');
           }else{
           	  $this->jump("index.php?p=Back&c=AuthManager&a=distribute&role_id={$role_id}", ':(发生未知错误，权限分配失败！');
           }
        }else{
		//输出权限信息
        $this->printAuth('role_id','AuthManager','role','分配权限','角色管理');
		//查询被分配权限的角色信息
        $role_id = $_GET['role_id'];
        $roleInfo = $role->getRoleIdInfo($role_id);

        //查询当前已经拥有的权限
        $have_authids = $roleInfo['role_auth_ids'];
        //转为数组判断是否存在更严谨
        $have_authids = explode(',', $have_authids);
        //获取可供选取的权限信息
	    //$auth_infoA = $role->selectAdminLevel(0); //父级
	    $auth_infoA = $role->selectAdminLevel(0); //0-1级别
	    $auth_infoB = $role->selectAdminLevel(1,2); //1-2级别

        //分配变量
        $this->assign('roleInfo',$roleInfo);
        $this->assign('have_authids',$have_authids);
        $this->assign('auth_infoA',$auth_infoA);
        $this->assign('auth_infoB',$auth_infoB);

		// 输出视图文件
		$this->display('role_distribution.html');
	  }
	}


	/**
	 * 权限列表显示
	 */
	public function authListAction(){
		$auth = Factory::M('AuthManagerModel');
		$authInfo = $auth->getAuthInfo();
		$this->assign('authInfo',$authInfo);
		// 以下代码与分页有关
		$rowsPerPage = 8; //每页记录数
		$maxNum = 8; //最大页码个数
		$url = "index.php?p=Back&c=AuthManager&a=authList&";
		$rowCount = $auth->getAuthCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 输出视图文件
		$this->display('auth_index.html');
	}

	/**
	 * 权限添加
	 */
	public function addAuthAction(){
		$auth = Factory::M('AuthManagerModel');
		//直接写2个逻辑
		if(!empty($_POST)){
			//var_dump($_POST); //收集只有4个数据(name,pid,controller,action)
			$result = $auth->saveAuthData($_POST);
			if($result){
				$this->jump("index.php?p=Back&c=AuthManager&a=authList", ':)恭喜你，添加权限成功！');
			}else{
				$this->jump("index.php?p=Back&c=AuthManager&a=addAuth", ':(发生未知错误，添加权限失败！');
			}
		}else{
           //获取上级权限信息
           $auth_InfoA = $auth->selectAdminLevel(0); //顶级
           $this->assign('auth_InfoA',$auth_InfoA);
		   $this->display('auth_add.html');
		}
	}

	/**
	 * 权限修改
	 */
	public function editAuthAction(){
		$auth = Factory::M('AuthManagerModel');
		//直接写2个逻辑
		if(!empty($_POST)){
			$auth_id = $_POST['auth_id'];
			$result = $auth->updateAuthData($_POST);
			if($result){
				$this->jump("index.php?p=Back&c=AuthManager&a=AuthList", ':)恭喜你，修改权限成功！');
			}else{
				$this->jump("index.php?p=Back&c=AuthManager&a=editAuth&auth_id='$auth_id'", ':(发生未知错误，修改权限失败！');
			}
		}else{
		   //输出权限信息
           $this->printAuth('auth_id','AuthManager','AuthList','权限修改','权限管理');
		   $auth_id = $_GET['auth_id'];
           //获取上级权限信息
           $auth_Info = $auth->selectAuthById($auth_id);
           $auth_infoA = $auth->selectAdminLevel(0); //父级
           $this->assign('auth_infoA',$auth_infoA);
           $this->assign('auth_Info',$auth_Info);
		   $this->display('auth_edit.html');
		}
	}

	/**
	 * 权限删除
	 */
	public function delAuthAction(){
		//输出权限信息
        $this->printAuth('auth_id','AuthManager','AuthList','权限删除','权限管理');
		$auth_id = $_GET['auth_id'];
		$auth = Factory::M('AuthManagerModel');
		$result = $auth->deleteAuth($auth_id);
		if($result){
			$this->jump("index.php?p=Back&c=AuthManager&a=authList", ':)恭喜你，删除权限成功！');
		}else{
			$this->jump("index.php?p=Back&c=AuthManager&a=authList", ':(发生未知错误，删除权限失败！');
		}
	}

	/**
	 * 权限批量删除
	 */
	public function delAllAuthAction() {

		// 先判断用户是否选择了文章
		if(!isset($_POST['auth_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=AuthManager&a=authList', ':( 请先选择要删除的权限！');
		}
		// 获取要删除的所有文章的id号
		$auth_ids = implode(',', $_POST['auth_id']); //以逗号分隔，把所有值连在一起
		// 调用模型
		$auth = Factory::M('AuthManagerModel');
		$result = $auth->delAllAuth($auth_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=AuthManager&a=authList',':)恭喜你，批量删除权限成功！');
		}else {
			$this->jump('index.php?p=Back&c=AuthManager&a=authList', ':( 发生未知错误,删除权限失败！');
		}
	}



}