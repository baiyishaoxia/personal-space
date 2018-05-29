<?php

/**
 * 前台会员管理控制器
 * @param username 用户名
 * @param username 用户邮箱
 */
class UserController extends PlatformController {
     private $username;
     private $useremail;

     /* 利用Ajax对注册信息进行实时刷新（已完善） */
     public function CheckregisterAction() {

        $username=isset($_POST['username'])?$_POST['username']:''; //接收注册用户名
        $ajaxname=Factory::M('UserModel');   //实例化用户模型
        $ajaxInfo = $ajaxname->checkregister_ajax($username);      //调用模型方法

     }
	    // 多余代码
	    // public function __construct() {
		// 	parent::__construct();
		// 	$this->register();
		// }

    /**
     * 公共方法
     */
     private function publicfunAction(){
     	// 调用MasterModel获取站长信息
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		// 分配变量
		$this->assign('masterInfo', $masterInfo);
		// 调用Article模型
		$article = Factory::M('ArticleModel');
		// 获取最新文章列表
		$maxnewArt = $GLOBALS['conf']['Home']['maxnewArt'];
		$newArt = $article->getNewArt($maxnewArt);
		// 分配变量
		$this->assign('newArt', $newArt);
		// 获取最热推荐文章列表
		$maxArtByHits = $GLOBALS['conf']['Home']['maxArtByHits'];
		$rmdArtByHits = $article->getRmdArtByHits($maxArtByHits);
		// 分配变量
		$this->assign('rmdArtByHits', $rmdArtByHits);
		// 调用FriendshipModel获取友情链接信息
		$friend = Factory::M('FriendshipModel');
		$friendInfo = $friend->getfrdInfo();
		//获取Banner信息
		$bannerInfo = $article->getBanner();
		$this->assign('bannerInfo', $bannerInfo);
		// 分配变量
		$this->assign('friendInfo', $friendInfo);
     } 
	/**
	 * 显示会员注册表单动作
	 */
	public function registerAction() {
		//初始化公共方法
		$this->publicfunAction();
		// 显示输出视图文件
		$this->display('register.html');
	}
  
  	/**
	 * 生成验证码图片的动作
	 */
	public function captchaAction() {
		// 实例化验证码类
		$captcha = Factory::M('Captcha');
		$captcha->generate();
	}
  
	/**
	 * 处理会员注册动作
	 */
	public function dealRegisterAction() {
		// 接收数据
		$userInfo = array();
		$user_name = $this->escapeData($_POST['user_name']);
        $verifycode = trim($_POST['verifycode']);
		$captcha = Factory::M('Captcha');
		// 判断用户名是否为空
		if(empty($user_name)) {
			$this->jump('index.php?p=Home&c=User&a=register', ':( 用户名不能为空！');
		}
		// 判断用户名是否超出长度
		if(strlen($user_name) > 12 || strlen($user_name) < 1) {
			$this->jump('index.php?p=Home&c=User&a=register', ':( 用户名的范围（1-12）位！');
		}
		// 判断用户名是否已经存在
		// 调用模型
		$user = Factory::M('UserModel');
		if($user->if_name_exists($user_name)) {
			// 用户已经存在
			$this->jump('index.php?p=Home&c=User&a=register', ':( 用户名已经存在！');
		}
		$userInfo['user_name'] = $user_name;
      	if(!$captcha->checkCaptcha($verifycode)) {
			// 验证码非法,跳转
			$this->jump('index.php?p=Home&c=User&a=register', ':( 验证码错误！');
		}
		// 判断密码是否一致
		$user_pass1 = trim($_POST['pass1']);
		$user_pass2 = trim($_POST['pass2']);
		if(empty($user_pass1) || empty($user_pass2)) {
			$this->jump('index.php?p=Home&c=User&a=register', ':( 密码不能为空！');
		}
		if($user_pass1 !== $user_pass2) {
			$this->jump('index.php?p=Home&c=User&a=register', ':( 两次密码不一致！');
		}
		$userInfo['user_pass'] = md5($user_pass1);
		// 判断是否上传了头像
		if($_FILES['user_image']['error'] != 4) {
			$upload = Factory::M('Upload');
			$allow = array('image/png', 'image/jpeg', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'user';
			// 调用uploadAction
			$result = $upload->uploadAction($_FILES['user_image'], $allow, $path);
					// 判断是否上传成功
					if($result) {
						// 生成缩略图
						$image = Factory::M('Image');
						$max_w = 50;
						$max_h = 50;
						$src_file = UPLOADS_DIR . 'user/' . $result; //原图的路径
						if($thumb = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
							$userInfo['user_thumb'] = $thumb;  //缩略图
						}else {
							$this->jump('index.php?p=Home&c=User&a=register', Image::$error);
						}
						    $userInfo['user_image'] = $result; //原图
					}else {
						// 上传失败,记录错误信息并跳转
						$error = Upload::$error;
						$this->jump('index.php?p=Home&c=User&a=register', $error);
					}
		}else {
			$userInfo['user_image'] = 'default.jpg'; //默认原图
			$userInfo['user_thumb'] = 'default.jpg'; //默认缩略图
		}
		$userInfo['user_email'] = $this->escapeData($_POST['user_email']);//邮箱
		$userInfo['user_time'] = time();
		// 调用模型,数据入库
		$result = $user->insertUser($userInfo);
		if($result) {
			$this->jump('index.php?p=Home&c=User&a=login', ':) 注册成功！');
		}else {
			$this->jump('index.php?p=Home&c=User&a=register', '发生未知错误,注册失败！');
		}
	}
	/**
	 * 显示会员登录表单动作
	 */
	public function loginAction() {
		//初始化公共方法
		$this->publicfunAction();
		// 显示输出视图文件
		$this->display('login.html');
	}
	/**
	 * 处理会员登录动作
	 */
	public function dealLoginAction() {
		// 接收数据
		$user_name = $this->escapeData($_POST['user_name']);
		$user_pass = trim($_POST['pass1']); //$this->escapeData($_POST['pass1']);
        $verifycode = trim($_POST['verifycode']);
        $captcha = Factory::M('Captcha');
        if(!$captcha->checkCaptcha($verifycode)) {
			// 验证码非法,跳转
			$this->jump('index.php?p=Home&c=User&a=login', ':( 验证码错误！');
		}
		if(empty($user_name) || empty($user_pass)) {
			$this->jump('index.php?p=Home&c=User&a=login', ':( 用户名和密码都不能为空！');
		}
		// 判断用户名和密码是否合法
		$user = Factory::M('UserModel');
		//判断用户是否被管理员拉黑
		
		$blacklist_user = $user->blacklistUser($user_name);
		
		$result = $user->check($user_name, md5($user_pass));
		if($result) {
			if(!$blacklist_user){
				$this->jump('index.php?p=Home&c=User&a=login','你最近非法操作，已被管理员禁止登陆！');
			}
			// 将用户信息存储到session中
			@session_start();
			$_SESSION['user_info'] = $result; // 数组信息
			$user->updateUserInfo($result['user_id']); //更新用户登录时间(完善)
			$this->jump('index.php?p=Home&c=Index&a=index');
		}else {
			$result = $user->checkName($user_name);
			if($result){
			$this->jump('index.php?p=Home&c=User&a=login', '用户名或密码错误！');	
		}else
			$this->jump('index.php?p=Home&c=User&a=login', '用户名不存在，请先注册！');
		}

	}
	/**
	 * logout用户退出动作
	 */
	public function logoutAction() {
		unset($_SESSION['user_info']);
		session_destroy();
		$this->jump('index.php?p=Home&c=Index&a=index');
	}
	/**
	*显示用户更换头像表单
	*/
	public function headimageAction() {
		 // 显示输出视图文件
		$this->display('upload_image.html');
	}
	//处理用户更换头像动作
	public function upload_image_dealAction() {
		// 1, 确定上传的参数
		$file = $_FILES['image'];  //表单的name(image)
		$allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
		$path = UPLOADS_DIR . 'user';
		// 2, 调用上传函数
		$upload = Factory::M('Upload');
		$result = $upload->uploadAction($file, $allow, $path);
		// 3, 判断是否上传成功、入库成功
			if($result) {
			// 生成缩略图
			$image = Factory::M('Image');
			$max_w = 70;
			$max_h = 60;
			$src_file = UPLOADS_DIR . 'user/' . $result; //原图的路径
			$userInfo = array();
			if($thumb = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
				$userInfo['user_thumb'] = $thumb;  //缩略图
			}else {
				$this->jump('index.php?p=Home&c=User&a=register', Image::$error);
			}
				$userInfo['user_image'] = $result; //原图
				// 提取当前登录者的名字
				@session_start();
				$userInfo['user_name'] = $_SESSION['user_info']['user_name'];
				// 先提取旧头像名
				$old_image = Factory::M('UserModel');
				$old_name = $_SESSION['user_info']['user_image'];
				//var_dump($old_name);die;
				// 入库,更新
				$res = $old_image->updateUserimage($userInfo);
				if($res) {
					// 入库更新成功
					if($old_name != 'default.jpg') {
					    unlink($path . '/' . $old_name); // 删除旧原头像
						unlink($path . '/' . 'thumb_'.$old_name); // 删除旧缩略头像
					}
					// 跳转
					$this->jump('index.php?p=Home&c=Index&a=index','头像上传成功！');
				}else {
					// 入库失败
					$this->jump('index.php?p=Home&c=User&a=headimage','头像上传失败！');
				}
		}else {
			// 上传失败,记录错误信息并跳转
			$error = Upload::$error;
			$this->jump('index.php?p=Home&c=User&a=register', $error);
		}
	}

	//修改用户信息操作
	public function CheckUserAction(){
		//初始化公共方法
        $this->publicfunAction();
	    // 显示输出视图文件
		$this->display('user_modify.html');
	}
	//处理修改用户信息
	public function dealModifyAction(){
		$userInfo = array();
		// 接收数据
		$userInfo['user_name'] = $this->escapeData($_POST['user_name']);
		$userInfo['user_email'] = $this->escapeData($_POST['user_email']);
		if(empty($userInfo['user_name']) || empty($userInfo['user_email'])) {
			$this->jump('index.php?p=Home&c=User&a=CheckUser', ':( 用户名和邮箱都不能为空！');
		}
		// 判断用户名和邮箱是否正确
		$user = Factory::M('UserModel');
		$result = $user->checkModify($userInfo);
		if($result) {
			// 将欲修改的用户信息存储到cookie中
			$this->username = $userInfo['user_name'];
			$this->useremail = $userInfo['user_email'];
			setcookie('username',"$this->username");
			setcookie('useremail',"$this->useremail");


		    //确认修改	
			$this->jump('index.php?p=Home&c=User&a=CheckTrueUser');
		}else {
			$this->jump('index.php?p=Home&c=User&a=CheckUser', '用户名或邮箱错误！');
		}
	}
	//确认信息后修改显示界面
	public function CheckTrueUserAction(){
		//初始化公共方法
        $this->publicfunAction();
	    // 显示输出视图文件
		$this->display('user_true_modify.html');
	}
	//处理修改密码操作
	public function dealTrueModifyAction(){
		$userInfo = array();
	    $userInfo['user_name'] = $_COOKIE['username'];
		$userInfo['user_email'] = $_COOKIE['useremail'];
		$user_pass1 = trim($_POST['pass1']); 
        $user_pass2 = trim($_POST['pass2']); 
        // 判断2次密码是否合法
		if($user_pass1 == $user_pass2) {
			//实例化
			$user = Factory::M('UserModel');
			$result = $user->modifyPassWord(md5($user_pass1),$userInfo);
			if($result){
				$this->jump('index.php?p=Home&c=User&a=login', ':) 用户密码修改成功！');
			}else 
			    $this->jump('index.php?p=Home&c=User&a=CheckTrueUser', ':( 发生未知错误，修改失败！');
		}else{
		    $this->jump('index.php?p=Home&c=User&a=CheckTrueUser', '两次密码不一致！');
		}
   }
}