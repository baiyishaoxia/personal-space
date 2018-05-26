<?php

/**
 * 文件上传类
 */
class Upload {
	// 定义公开静态属性,用于记录错误信息
	public static $error;
	/**
	 * 实现文件上传方法
	 * @param array $file 上传的文件的信息(一维数组,5个元素信息)
	 * @param array $allow 允许上传的类型
	 * @param string $path 文件上传的目录
	 * @param int $maxsize = 1048576 允许上传的文件的大小
	 * @return mixed false|$newname 上传失败返回false成功返回文件的新名字
	 */
	public function uploadAction($file, $allow, $path, $maxsize=1048576) {
		// 1,先判断系统错误
		switch($file['error']) {
			case 1 : self::$error = '上传失败！超出了文件限制的大小！'; 
					 return false;
			case 2 : self::$error = '上传失败！超出了浏览器规定的文件的大小！';
					 return false;
			case 3 : self::$error = '上传失败，文件上传不完整！';
					 return false;
			case 4 : self::$error = '上传失败，请先选择要上传的文件！';
					 return false;
			case 6 :
			case 7 : self::$error = '对不起，服务器繁忙，请稍后再试！';
					 return false;
		}
		// 2, 判断逻辑错误
		if($file['size'] > $maxsize) { 
			self::$error = "上传失败，超出了文件限制的大小！";
			return false;
		}
		if(!in_array($file['type'], $allow)) {
			// 非法的文件类型
			self::$error =  "上传的文件的类型不正确，允许的类型有：" . implode(',', $allow);
			return false;
		}
		// 3, 移动临时文件
		// 先得到该文件的随机名
		$newname = $this->randName($file['name']);
		$target = $path . '/' . $newname;
		// 开始移动
		$result = move_uploaded_file($file['tmp_name'], $target);
		if($result) {
			return $newname;
		}else {
			self::$error = "发生未知错误，上传失败！";
			return false;
		}
	}
	/**  
	 * 生成一个随机名字的方法
	 * @param string $filename 文件的原始名字
	 * @return string $newname 文件的新名字
	 */ 
	private function randName($filename) {
		// 1, 生成文件的时间部分
		$newname = date('YmdHis');
		// 2, 加上随机产生的6位数
		$str = "0987654321";
		for($i=0; $i<6; $i++) {
			$newname .= $str[mt_rand(0,strlen($str)-1)];
		}
		// 3, 加上文件的后缀名
		$newname .= strrchr($filename, '.');
		return $newname;
	}
}