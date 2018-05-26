<?php

/**
 * 图像处理类
 */
class Image {
	public static $error; // 用来记录错误信息
	/**
	 * 制作缩略图
	 * @param int $max_w 缩略图画布最大的宽
	 * @param int $max_h 缩略图画布最大的高
	 * @param string $src_file 原图像的路径+名称
	 * @param string $path 缩略图的输出路径
	 * @param int $red = 255
	 * @param int $green = 255
	 * @param int $blue = 255
	 * @return bool|string false|$thumb 缩略图名称
	 */
	public function makeThumb($max_w, $max_h, $src_file, $path, $red=255, $green=255, $blue=255) {
		// 1, 判断$src_file是否合法
		if(!file_exists($src_file)) {
			self::$error = '原图像不存在!';
			return false;
		}
		if(!getimagesize($src_file)) {
			// 原图像信息不合法
			self::$error = '原图像类型不合法!';
			return false;
		}
		// 2, 创建原图像画布
		$src_info = getimagesize($src_file); //获取图像信息
		switch($src_info[2]) {
			case 1: $type = 'gif';break;
			case 2: $type = 'jpeg';break;
			case 3: $type = 'png';
		}
		$create_name = 'imagecreatefrom' . $type;
		$src_img = $create_name($src_file); // 可变函数(创建原图画布)
		// 3, 创建缩略图画布并填充背景色
		$dst_img = imagecreatetruecolor($max_w, $max_h);
		$bgColor = imagecolorallocate($dst_img, $red, $green, $blue);
		imagefill($dst_img, 0, 0, $bgColor);
		// 4, 计算相关参数
		$dst_wh = $max_w / $max_h; // 缩略图画布宽高比
		$src_w = $src_info[0];
		$src_h = $src_info[1];
		$src_wh = $src_w / $src_h; // 原图宽高比
		// 5, 确定拷贝到缩略图画布的图片的宽和高
		if($src_wh > $dst_wh) {
			$dst_w = $max_w;
			$dst_h = floor($dst_w / $src_wh);
		}else {
			$dst_h = $max_h;
			$dst_w = floor($dst_h * $src_wh);
		}
		// 6, 确定拷贝到略图画布的图片的坐标
		$dst_x = ($max_w - $dst_w) / 2;
		$dst_y = ($max_h - $dst_h) / 2;
		// 7, 采样、拷贝
		if(imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $src_w, $src_h)) {
			// 采样成功
			// 先得到原图的名称
			$filename = basename($src_file); // 去掉字符串中的路径,只保留最后的名称
			// 拼凑出缩略图的名称
			$thumb = 'thumb_' . $filename;
			// 保存图片
			$save_name = 'image' . $type; //可变函数
			$save_name($dst_img, $path . '/'. $thumb);
			// 销毁画布资源
			imagedestroy($dst_img);
			imagedestroy($src_img);
			// 返回缩略图的名称
			return $thumb;
		}else {
			// 采样失败
			// 销毁画布资源
			imagedestroy($dst_img);
			imagedestroy($src_img);
			self::$error = '发生未知错误,缩略图生成失败!';
			return false;
		}
	}
}
