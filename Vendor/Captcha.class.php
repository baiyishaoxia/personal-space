<?php

/**
 * 验证码工具类
 */
class Captcha {
	// 定义相关属性
	private $width;   // 宽
	private $height;  // 高
	private $pixelnum;// 干扰点密度
	private $linenum; // 干扰线数量
	private $stringnum; // 验证码字符的个数
	private $string;	// 要写入的随机字符串
	/**
	 * 构造方法
	 */
	public function __construct() {
		// 初始化相关属性
		$this->initParams();
	}
	/**
	 * 初始化相关属性
	 */
	private function initParams() {
		// 从配置文件中初始化属性
		$this->width = $GLOBALS['conf']['Captcha']['width'];
		$this->height = $GLOBALS['conf']['Captcha']['height'];
		$this->pixelnum = $GLOBALS['conf']['Captcha']['pixelnum'];
		$this->linenum = $GLOBALS['conf']['Captcha']['linenum'];
		$this->stringnum = $GLOBALS['conf']['Captcha']['stringnum'];
	}
	/**
	 * 生成验证码图片
	 */
	public function generate() {
		// 1, 创建画布
		$img = imagecreatetruecolor($this->width, $this->height);
		// 2, 填充背景
		// 2.1 创建背景色句柄
		$backcolor = imagecolorallocate($img,  mt_rand(200,255), mt_rand(150,255), mt_rand(200,255));
		// 2.2 填充背景
		imagefill($img, 0, 0, $backcolor);
		// 3, 得到随机验证码字符串
		$this->string = $this->getRandString();
		// 4, 验证码字符串写到图片上
		// 4.1 计算字符间隔
		$span = ceil($this->width/($this->stringnum + 1));
		// 4.2 循环写入单个字符
		for($i=1;$i<=$this->stringnum;$i++) {
			$stringcolor = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,100), mt_rand(0,80));
			imagestring($img, 5, $i*$span, ($this->height/2)-6, $this->string[$i-1], $stringcolor);
		}
		// 5, 添加干扰线
		for($i=1;$i<=$this->linenum;$i++) {
			$linecolor = imagecolorallocate($img, mt_rand(0,150), mt_rand(30,250), mt_rand(200,255));
			$x1 = mt_rand(0, $this->width - 1);
			$y1 = mt_rand(0, $this->height - 1);
			$x2 = mt_rand(0, $this->width - 1);
			$y2 = mt_rand(0, $this->height - 1);
			imageline($img, $x1, $y1, $x2, $y2, $linecolor);
		}
		// 6, 添加干扰点
		for($i=1;$i<=$this->width*$this->height*$this->pixelnum;$i++) {
			$pixelcolor = imagecolorallocate($img, mt_rand(100,150), mt_rand(0,120), mt_rand(0,255));
			imagesetpixel($img, mt_rand(0,$this->width-1),mt_rand(0,$this->height-1), $pixelcolor);
		}
		// 7, 输出图片
		header("Content-type:image/png");
		ob_clean();// 清理数据缓冲区
		imagepng($img);
		// 8, 销毁图片
		imagedestroy($img);
	}
	/**
	 * 得到随机验证码字符串
	 */
	private function getRandString() {
		$arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
		shuffle($arr);
		$rand_keys = array_rand($arr, $this->stringnum);
		$str = '';
		foreach ($rand_keys as $value) {
			$str .= $arr[$value];
		}
		// 保存到session变量中
		@session_start();
		$_SESSION['captcha'] = $str;
		return $str;
	}
	/**
	 * 设置长和宽的公开方法
	 */
	public function setWidth($w) {
		$this->width = $w;
	}
	public function setHeight($h) {
		$this->height = $h;
	}
	/**
	 * 验证验证码是否合法的公开方法
	 */
	public function checkCaptcha($passcode) {
		@session_start();
		if(strtolower($passcode) !== strtolower($_SESSION['captcha'])) {
			return false;
		}else {
			return true;
		}
	}
}