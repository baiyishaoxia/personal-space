<?php

return array(
	'db'	=>	array( // 数据库信息组
		'host'	=>	'127.0.0.1',
		'port'	=>	'3306',
		'user'	=>	'root',
		'pass'	=>	'',
		'charset'=>	'utf8',
		'dbname' => 'bbk'
	),
	'App'	=>	array( // 应用程序组
		'default_platform'=>'Home',
		'dao'	=>	'pdo',// 这里可以是pdo或mysql
		'platform_url' => 'http://www.bbk.com' //网站默认地址
	),
	'Home'	=>	array( // 前台组
		'default_controller'=>'Index',
		'default_action'	=>'index',
		'maxrecommend'      => 5, //最大“推荐文章”展示数(与模块中的栏目推荐同步)
		'maxnewArt'         => 8, //最大“最新文章列表”数
		'maxsortByHits'     => 9, //最大“点击排行”数 
		'maxArtByHits'      => 10  //最大“推荐文章”列表数(首页右侧)
	),
	'Back'	=>	array(	// 后台组
		'default_controller'=>'Admin',
		'default_action'	=>'login'
	),
	'Captcha'=>	array( // 验证码信息组
		'width'	=>	80,
		'height'=>	32,
		'pixelnum'=> 0.02,//干扰点密度
		'linenum' => 5,// 干扰线数量
		'stringnum'=> 4, // 验证码字符个数
	),
	'Page'	=>	array( // 分页信息组
		'rowsPerPage'=>5,//每页显示的记录数 (后台)
		'HomeRowPage'=>7,//每页显示的记录数 (前台)
		'maxNum'=>5  // 页面上能显示的最多有多少个页码面
	),
	// 其他
	// 错误处理
	'error' =>array(
        'mysqlError' => LOG_DIR,
        'mysqlname'  => 'mysqlError.log',
	),
);

