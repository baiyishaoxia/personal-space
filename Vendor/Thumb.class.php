<?php
/*
*判断是否上传了图片(缩略图)
*/
class Thumb {
	public function Thumbcheck($controller,$action) {
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
					$this->jump("index.php?p=Back&c='$controller'&a='$action'", Image::$error);
				}
				$user['user_image']=$result; //原图
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump("index.php?p=Back&c='$controller'&a='$action'", $error);
			}
		}else {
			$user['user_image'] = 'default.jpg';  //默认缩略图
		}
		return $user['user_image'];
	}
  }