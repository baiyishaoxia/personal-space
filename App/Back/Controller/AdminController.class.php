<?php

/**
 * 后台管理员控制器(登录、注销、管理员的增删改查等)
 */
class AdminController extends PlatformController {
	private $auth_infoA;
	private $auth_infoB;
	private $auth_ids;
	/**
	 * 展示登录表单动作
	 */
	public function loginAction() {
		// 载入当前的视图文件
		$this->display('login.html');
	}
	/**
	 * 后台注销功能
	 */
	public function logoutAction() {
		@session_start();
		// 删除相关会话数据
		unset($_SESSION['adminInfo']);
		// 删除会话数据区
		session_destroy();
		// 立即跳转到登录页面
		$this->jump('index.php?p=Back&c=Admin&a=login');
	}
	/**
	 * 验证管理员的合法性
	 */
	public function checkAction() {
		// 接收表单数据
		$admin_name = $this->escapeData($_POST['admin_name']);
		$admin_pass = $_POST['admin_pass'];
		$passcode = trim($_POST['passcode']);
		$captcha = Factory::M('Captcha');
		if(!$captcha->checkCaptcha($passcode)) {
			// 验证码非法,跳转
			$this->jump('index.php?p=Back&c=Admin&a=login', ':( 验证码错误！');
		}
		// 从数据库中验证管理员的合法性
		// 实例化模型
		$admin = Factory::M('AdminModel');
		if($row = $admin->check($admin_name, $admin_pass)) {
			// 如果合法,应该把用户信息放到session中
			@session_start(); // 确定开启session机制
			// 设置session的生命周期
			$lifeTime = 2 * 3600; 
            @session_set_cookie_params($lifeTime);
            //将验证符合返回的一条查询信息结果存入session
			$_SESSION['adminInfo'] = $row;  
			// 更新当前管理员信息
			$admin->updateAdminInfo($row['admin_id']);


        //权限设置
        //根据管理员获取其角色，进而获取角色对应的权限
        //1.根据管理员id信息获取本身记录
        $admin_id = $row['admin_id'];
        $admin_name = $row['admin_name'];
        $auth = Factory::M('AuthManagerModel');
        $manager_info =  $auth->find($admin_id);
        //角色id
        $role_id = $manager_info['ad_role_id'];

        //2.根据角色id获取本身记录信息
        //admin超级管理员无权限限制
        $role_info = $auth->findRoleId($role_id);
        if($role_id == 0){
        	$this->auth_ids ='';
        }else $this->auth_ids = $role_info[0]['role_auth_ids'];

        //3.根据auth_ids获取具体权限 （已转移到平台控制器中）
        //$this->auth_info = serialize($auth->selectRoleIds($auth_ids));
        // if($admin_name == 'admin'){
	       //  $this->auth_infoA = serialize($auth->selectAdminLevel(0)); //父级

	       //  $this->auth_infoB = serialize($auth->selectAdminLevel(1,2)); //子级

        // }else{
	       //  $this->auth_infoA = serialize($auth->selectLevel($auth_ids,0)); //父级
	       //  $this->auth_infoB = serialize($auth->selectLevel($auth_ids,1,2)); //子级
        // }
        
		// 分配变量 （包含父子级）
		//$this->assign('auth_info', $auth_info);
        setcookie('auth_ids',"$this->auth_ids");
		setcookie('auth_infoA',"$this->auth_infoA");
        setcookie('auth_infoB',"$this->auth_infoB");



			// 直接跳转到后台管理首页
			$this->jump('index.php?p=Back&c=Manage&a=index');
		}else {
			// 验证非法,给出提示后跳转
			$this->jump('index.php?p=Back&c=Admin&a=login', ':( 用户名或密码错误！');
		}
	}
	/**
	 * 生成验证码图片的动作
	 */
	public function captchaAction() {
		// 实例化验证码类
		$captcha = Factory::M('Captcha');
		$captcha->generate();
	}


}