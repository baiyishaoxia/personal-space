<?php
/**
 * 用户管理控制器
 */
class UserController extends PlatformController {
	/**
	 * 用户管理首页动作
	 */
	public function indexAction() {
		// 实例化模型,提取所有的用户信息
		$user = Factory::M('UserModel');
		$userInfo = $user->getUser();
		// 分配变量
		$this->assign('userInfo', $userInfo);
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage']; //每页记录数
		$maxNum = $GLOBALS['conf']['Page']['maxNum']; //最大页码个数
		$url = "index.php?p=Back&c=User&a=index&";
		$rowCount = $user->getRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分页到此结束
		// 输出视图文件
		$this->display('index.html');
	}
	/**
	 * 显示添加用户表单的动作
	 */
	public function addAction() {
		// 输出视图文件
		$this->display('add.html');
	}
	/**
	 * 处理添加用户表单的动作
	 */
	public function dealAddAction() {
		// 接收表单
		$user = array();
		$user['user_name'] = $this->escapeData($_POST['user_name']);
		$user['user_pass'] = $this->escapeData($_POST['user_pass']);
		// 判断数据合法性
		if(empty($user['user_name']) || empty($user['user_pass'])) {
			$this->jump('index.php?p=Back&c=User&a=add', ':( 您填写的数据不完整');
		}
        // 判断是否有缩略图上传
		if($_FILES['thumb']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'user';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['thumb'], $allow, $path); //返回来的是新名字
			// 判断是否上传成功
			if($result) {
				// 生成缩略图
				$image = Factory::M('Image');
				$max_w = 175;
				$max_h = 115;
				$src_file = UPLOADS_DIR . 'user/' . $result;
				if($thumb = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
					$user['user_image'] = $thumb;  //缩略图
				}else {
					$this->jump("index.php?p=Back&c=User&a=add", Image::$error);
				}
				$user['user_image']=$result; //原图
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump("index.php?p=Back&c=User&a=add", $error);
			}
		}else {
			$user['user_image'] = 'default.jpg';  //默认缩略图
		}
		// 调用模型,数据入库
		$userInfo = Factory::M('UserModel');
		$result = $userInfo->insertUser($user);
		if($result) {
			$this->jump('index.php?p=Back&c=User&a=index');
		}else {
			$this->jump('index.php?p=Back&c=User&a=add', ':( 发生未知错误,添加用户失败！');
		}
	}
	/**
	 * 根据id号实现用户删除动作
	 */
	public function delAction() {
		//输出权限信息
        $this->printAuth('user_id','User','index','删除','用户列表');
		// 要获取要删除的文章的id号
		$user_id = $_GET['user_id'];
		// 实例化模型
		$user = Factory::M('UserModel');
		//原图的信息
		$del_thumb=$user->getUserInfoById($user_id);
        $thumb=$del_thumb['user_image'];
		$result = $user->delUserById($user_id);
		if($result) {
			if($thumb != 'default.jpg') {
			unlink(UPLOADS_DIR . 'user/' . $thumb); //删除原图 (垃圾回收)
			unlink(UPLOADS_DIR . 'user/' . 'Thumb_'.$thumb); //删除缩略图
			}
			$this->jump('index.php?p=Back&c=User&a=index');
		}else {
			$this->jump('index.php?p=Back&c=User&a=index', ':( 发生未知错误,删除用户失败！');
		}
	}
	/**
	 * 根据id号实现用户批量删除动作
	 */
	public function delAllAction() {
		//输出权限信息
        $this->printAuth('user_id','User','index','批量删除','用户列表');
	    // 先判断用户是否选择了文章
		if(!isset($_POST['user_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=User&a=index', ':( 请先选择要删除的用户！');
		}
		// 获取要彻底删除的所有文章的id号
		$user_ids = implode(',', $_POST['user_id']);
		// 调用模型
		$user = Factory::M('UserModel');
		//原图的信息
		$result = $user->DelAllUser($user_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=User&a=index');
		}else {
			$this->jump('index.php?p=Back&c=User&a=index', ':( 发生未知错误,批量删除用户失败！');
		}
	}
	/**
	 * 用户状态信息(0正常1已停用)
	 */
	public function ifUserBlackAction(){
		//输出权限信息
        $this->printAuth('user_id','User','index','用户状态','用户列表');
		// 接收用户id
		$user_id = $_GET['user_id'];
		// 接收状态
		$is_type = $_GET['is_type'];
		// 接收当前页码
		$pageNum = $_GET['pageNum'];
		// 调用模型
		$user = Factory::M('UserModel');
		$result = $user->updateTypeById($user_id, $is_type);
		if($result) {
			$this->jump("index.php?p=Back&c=User&a=index&pageNum=$pageNum");
		}else {
			$this->jump("index.php?p=Back&c=User&a=index&pageNum=$pageNum", '发生未知错误,操作失败!');
		}
	}
}
