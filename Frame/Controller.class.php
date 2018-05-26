<?php

/**
 * 基础控制器类
 */
class Controller {
	// 定义一个属性,用于保存Smarty对象
	protected $smarty;
	/**
	 * 构造方法
	 */
	public function __construct() {
		// 初始化文件编码
		$this->initCode();
		// 初始化Smarty
		$this->initSmarty();
	}
	/**
	 * 初始化文件编码
	 */
	protected function initCode() {
		header("Content-type:text/html;Charset=utf-8");
	}
	/**
	 * 初始化Smarty
	 */
	protected function initSmarty() {
		// 实例化Smarty
		$this->smarty = new Smarty;
		// 设置模板路径
		$this->smarty->setTemplateDir(CURRENT_VIEW_DIR . CONTROLLER . '/');
		// 设置编译文件路径
		$this->smarty->setCompileDir(APP_DIR . PLATFORM . '/View_c/' . CONTROLLER . '/');
	}
	protected function assign($name, $value) {
		// 调用smarty对象的assign方法
		$this->smarty->assign($name, $value);
	}
	protected function display($tpl) {
		// 调用smarty对象的display方法
		$this->smarty->display($tpl);
	}
	/**
	 * 跳转
	 * @param $url 目标URL
	 * @param $info 提示信息
	 * @param $time 等待时间(单位秒)
	 */
	protected function jump($url, $info=NULL, $time=3) {
		// 先判断是立即跳转还是刷新跳转
		if(is_null($info)) {
			// 说明是立即跳转
			header('location:' . $url);
			die;
		}else {
			// 说明是刷新跳转,应该给出提示
			// 直接利用定界符输出模板
			echo <<<TIAOZHUAN
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		    <title>提示信息</title>
		    <style type='text/css'>
		        * {margin:0; padding:0;}
		        div {width:390px; height:287px; border:1px #09C solid; position:absolute; left:50%; margin-left:-195px; top:10%;}
		        div h2 {width:100%; height:30px; line-height:30px; background-color:#09C; font-size:14px; color:#FFF; text-indent:10px;}
		        div p {height:120px; line-height:120px; text-align:center;}
		        div p strong {font-size:26px;}
		    </style>
			<div>
		        <h2>提示信息</h2>
		        <p>
		            <strong>$info</strong><br />
					页面在<span id="second">$time</span>秒后会自动跳转，或点击<a id="tiao" href="$url">立即跳转</a>
		        </p>
		    </div>
		    <script type="text/javascript">
		        var url = document.getElementById('tiao').href;
		        function daoshu(){
		            var scd = document.getElementById('second');
		            var time = --scd.innerHTML;
		            if(time<=0){
		                window.location.href = url;
		                clearInterval(mytime);
		            }
		        }
		        var mytime = setInterval("daoshu()",1000);
		    </script>
TIAOZHUAN;
		die;
		}
	}
	/**
     * 对用户的数据进行安全过滤
     */
	protected function escapeData($data) {
		return addslashes(strip_tags(trim($data))); //去两边空格、标签、再加转义(防止注入、恶意攻击)
	}
}