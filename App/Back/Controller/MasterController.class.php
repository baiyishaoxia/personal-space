<?php

/**
 * 站长管理控制器
 */
class MasterController extends PlatformController {
	/**
	 * 显示站长信息
	 */
	public function indexAction() {
		// 调用模型
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		// 分配变量
		$this->assign('masterInfo', $masterInfo);
		// 输出视图文件
		$this->display('index.html');
	}
	/**
	 * 更新站长信息
	 */
	public function editAction() {
		//输出权限信息
        $this->printAuth('id','Master','index','修改','站长信息');
		// 接收表单数据
		$masterInfo = array();
		$masterInfo['aboutname'] = $this->escapeData($_POST['aboutname']);
		$masterInfo['signature'] = $this->escapeData($_POST['signature']);
		$masterInfo['nickname'] = $this->escapeData($_POST['nickname']);
		$masterInfo['job'] = $this->escapeData($_POST['job']);
		$masterInfo['home'] = $this->escapeData($_POST['home']);
		$masterInfo['tel'] = $this->escapeData($_POST['tel']);
		$masterInfo['email'] = $this->escapeData($_POST['email']);
		// 验证数据
		if(empty($masterInfo['aboutname']) || empty($masterInfo['signature']) || empty($masterInfo['nickname']) || empty($masterInfo['job']) || empty($masterInfo['home']) || empty($masterInfo['tel']) || empty($masterInfo['email'])) {
			$this->jump('index.php?p=Back&c=Master&a=index', ':( 信息填写不完整!');
		}
		// 判断是否有头像上传
		if($_FILES['headerthumb']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'headerthumb';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['headerthumb'], $allow, $path); //返回的新名字就是原图名
			// 判断是否上传成功
			if($result) {
				$masterInfo['headerthumb'] = $result; //保存原图
				//回收机制
				if($_POST['header_thumb'] != 'default.jpg') {
					    unlink(UPLOADS_DIR . 'headerthumb/' . $_POST['header_thumb']); //删除原图 
				}
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump('index.php?p=Back&c=Master&a=index', $error);
			}
		}else {
			   if(!empty($_POST['header_thumb'])){
			      $masterInfo['headerthumb'] = $_POST['header_thumb']; // 未上传就使用以前的缩略图
			   } else {
				  $masterInfo['headerthumb'] = 'default.jpg'; // 没有以前的就是用默认
			   }
		}
		// 调用模型,更新
		$master =  Factory::M('MasterModel');
		$result = $master->updateMasterInfo($masterInfo);
		if($result) {
			$this->jump('index.php?p=Back&c=Master&a=index', ':) 更改成功!');
		}else {
			$this->jump('index.php?p=Back&c=Master&a=index', ':( 发生未知错误,更改失败!');
		}
	}
}