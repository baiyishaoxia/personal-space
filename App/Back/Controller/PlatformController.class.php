<?php

/**
 * 后台的平台控制器
 */
class PlatformController extends Controller {
	/**
	 * 判断后台管理员是否登录防止用户翻墙
	 */
	protected function checkLogin() {
		// 先列出不需要登录验证的动作列表
		$no_need = array(
			// 控制器名	=> 该控制器下不需要验证的动作列表
			'Admin'	=>	array('login', 'check', 'captcha'),
		);
		if(isset($no_need[CONTROLLER]) && in_array(ACTION, $no_need[CONTROLLER])) {
			// 说明当前控制器下的当前方法不需要验证
			return ;
		}
		@session_start();
		if(!isset($_SESSION['adminInfo'])) {
			// 说明还没有登录,跳转到登录页面
			$this->jump('index.php?p=Back&c=Admin&a=login',':( 请您先登录！');
		}
	}

    //公共左侧菜单动作（为每个用户分配不同的权限，看到的效果不一样）
	protected function publicMenu(){
		//获取cookie信息
        // $auth_infoa = isset($_COOKIE['auth_infoA'])?$_COOKIE['auth_infoA']:'';
        // $auth_infob = isset($_COOKIE['auth_infoB'])?$_COOKIE['auth_infoB']:'';
        //反序列化得到父子级
        // $auth_infoA = unserialize($auth_infoa);
        // $auth_infoB = unserialize($auth_infob);
        $admin_name = isset($_SESSION['adminInfo']['admin_name'])?$_SESSION['adminInfo']['admin_name']:'0';
        $auth_ids = isset($_COOKIE['auth_ids'])?$_COOKIE['auth_ids']:'0';
        $auth = Factory::M('AuthManagerModel');
        if($admin_name == 'admin'){
	        $auth_infoA = $auth->selectAdminLevel(0); //父级
	        $auth_infoB = $auth->selectAdminLevel(1,2); //子级

        }else{
	        $auth_infoA = $auth->selectLevel($auth_ids,0); //父级
	        $auth_infoB = $auth->selectLevel($auth_ids,1,2); //子级
        }
		//分配权限变量
        $this->assign('auth_infoA', $auth_infoA);
        $this->assign('auth_infoB', $auth_infoB);
	}


	/**
	 * 构造方法
	 */
	public function __construct() {
		// 先显式的调用父类构造方法
		parent::__construct();
		// 判断后台管理员是否登录防止用户翻墙
		$this->checkLogin();
		//初始化菜单动作
		$this->publicMenu();

		//实现权限中的各个方法过滤功能
		//获取当前用户访问的权限信息和操作方法
		$now_ac = CONTROLLER."-".ACTION;
		//当前访问权限与允许访问权限作对比
		$admin_id = isset($_SESSION['adminInfo']['admin_id'])?$_SESSION['adminInfo']['admin_id']:'0';
		$admin_name = isset($_SESSION['adminInfo']['admin_name'])?$_SESSION['adminInfo']['admin_name']:'0';
		$admin = Factory::M('AuthManagerModel');
		$admin_info = $admin->getAdminInfobyId($admin_id);
		//通过管理员信息进一步获取角色信息
		$role_info =$admin->getAdminRole($admin_info['ad_role_id']);
		//获取role_auth_ac操作方法信息
		$auth_ac = $role_info['role_auth_ac'];

        //默认允许大家都可以访问的权限
        $allow_ac = "Admin-logout,Admin-login,Admin-check,Admin-captcha,Manage-index";
        
        //越权翻墙访问过滤判断
		//1.当前访问的权限 没有出现在 其拥有权限列表里
		//2.当前访问的权限 也没有出现在 默认允许权限里
		//3.访问者还不是admin超级管理员
		//那么当前权限 就是 没有权限访问

		//利用$now_ac 与 $auth_ac作对比
		//strpos判断小的字符串在大的字符串中第一次出现的位置
		if(strpos($auth_ac, $now_ac)===false && strpos($allow_ac, $now_ac)===false && $admin_name !== 'admin'){
			exit('您目前没有权限访问，请与管理员联系！');
		}


	}

	/**
	 * 权限输出说明
	 */
	protected function printAuth($id,$controller,$action,$text1,$text2){
		//echo $_GET["$id"];die;
		if(!isset($_GET["$id"])){
			$this->jump("index.php?p=Back&c={$controller}&a={$action}", ":( 你拥有{$text1}权限,请到{$text2}中操作！", 3);
			exit();	
		}
	}

}