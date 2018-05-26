<?php
/**
 * 后台文章管理控制器
 */
class ArticleController extends PlatformController {
	/**
	 * 文章管理首页动作
	 */
	public function indexAction() {
		// 实例化模型,提取所有的文章信息
		$article = Factory::M('ArticleModel');
		$artInfo = $article->getArticle();
		// 分配变量
		$this->assign('artInfo', $artInfo);
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage']; //每页记录数
		$maxNum = $GLOBALS['conf']['Page']['maxNum']; //最大页码个数
		$url = "index.php?p=Back&c=Article&a=index&";
		$rowCount = $article->getRowCount(); // 获取总记录数
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
	 * 显示添加文章表单的动作
	 */
	public function addAction() {
		// 需要先提取文章分类信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		// 分配变量
		$this->assign('cateInfo', $cateInfo);
		// 输出视图文件
		$this->display('add.html');
	}
	/**
	 * 处理提交文章表单的动作
	 */
	public function dealAddAction() {
		// 接收表单
		$art = array();
		$art['cate_id'] = $_POST['cate_id'];
		$art['title'] = $this->escapeData($_POST['title']);
		// $art['content'] = $this->escapeData($_POST['content']); 由于添加了在线编辑器
		$art['content'] = addslashes($_POST['content']);
		$art['art_desc'] = $this->escapeData($_POST['art_desc']);
		$art['author'] = $this->escapeData($_POST['author']);
		// 判断数据合法性
		if(empty($art['title']) || empty($art['content']) || empty($art['art_desc']) || empty($art['author'])) {
			$this->jump('index.php?p=Back&c=Article&a=add', ':( 您填写的数据不完整');
		}
		if(empty($art['cate_id'])) {
			$this->jump('index.php?p=Back&c=Article&a=add', ':( 请选择文章类型！');
		}
		// 判断是否有图片上传
		if($_FILES['thumb']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'thumb';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['thumb'], $allow, $path); //返回来的是新名字
			// 判断是否上传成功
			if($result) {
				// 生成缩略图
				$image = Factory::M('Image');
				$max_w = 175;
				$max_h = 115;
				$src_file = UPLOADS_DIR . 'thumb/' . $result; //原图的路径
				if($thumb = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
					$art['thumb'] = $thumb;  //缩略图
				}else {
					$this->jump('index.php?p=Back&c=Article&a=add', Image::$error);
				}
				$art['first_thumb']=$result; //原图
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump('index.php?p=Back&c=Article&a=add', $error);
			}
		}else {
			$art['thumb'] = 'default.jpg';  //默认缩略图
			$art['first_thumb']='default.jpg'; //默认原图
		}
		// 调用模型,数据入库
		$article = Factory::M('ArticleModel');
		$result = $article->insertArt($art);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=index',':)文章发布成功');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=add', ':( 发生未知错误,发布文章失败！');
		}
	}
	/**
	 * 显示修改文章表单动作 
	 */
	public function editAction() {
		//输出权限信息
        $this->printAuth('art_id','Article','index','修改','文章列表');
		// 接收文章id号
		$art_id = $_GET['art_id'];
		// 获取当前文章的信息
		$article = Factory::M('ArticleModel');
		$artInfoById = $article->getArtInfoById($art_id);
		// 分配变量
		$this->assign('artInfoById', $artInfoById);
		// 获取文章类别信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		// 分配变量
		$this->assign('cateInfo', $cateInfo);
		// 输出视图文件
		$this->display('edit.html');
	}
	/**
	 * 处理修改文章表单的动作
	 */
	public function dealEditAction() {
		// 接收表单
		$art = array();
		$art['art_id'] = $_POST['art_id'];//从隐藏域中接收文章id号
		$art['cate_id'] = $_POST['cate_id'];  //所属文章的id号
		$art['title'] = $this->escapeData($_POST['title']);
		$art['content'] = addslashes($_POST['content']);
		$art['art_desc'] = $this->escapeData($_POST['art_desc']);
		$art['author'] = $this->escapeData($_POST['author']);
		// 判断数据合法性
		if(empty($art['title']) || empty($art['content']) || empty($art['art_desc']) || empty($art['author'])) {
			$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}", ':( 您填写的数据不完整');
		}
		if(empty($art['cate_id'])) {
			$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}", ':( 请选择文章类型！');
		}
		// 判断是否有缩略图上传
		if($_FILES['thumb']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'thumb';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['thumb'], $allow, $path); //返回的新名字就是原图名
			// 判断是否上传成功
			if($result) {
				// 生成缩略图
				$image = Factory::M('Image');
				$max_w = 175;
				$max_h = 115;
				$src_file = UPLOADS_DIR . 'thumb/' . $result;
				if($thumb = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
					$art['thumb'] = $thumb;  //保存缩略图
				}else {
					$this->jump('index.php?p=Back&c=Article&a=edit', Image::$error);
				}
				$art['first_thumb'] = $result; //保存原图
				//回收机制
				if($_POST['thumb_bak'] != 'default.jpg') {
					    unlink(UPLOADS_DIR . 'thumb/' . $_POST['first_thumb']); //删除原图 
						unlink(UPLOADS_DIR . 'thumb/' . $_POST['thumb_bak']);  //删除缩略图
				}
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}", $error);
			}
		}else {
			$art['thumb'] = $_POST['thumb_bak']; // 以前的缩略图
		}
		// 调用模型,数据入库
		$article = Factory::M('ArticleModel');
		$result = $article->UpdateArtById($art);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else {
			$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}", ':( 发生未知错误,修改文章失败！');
		}
	}
	/**
	 * 根据id号删除文章
	 */
	public function delAction() {
		//输出权限信息
        $this->printAuth('art_id','Article','index','删除','文章列表');
		// 要获取要删除的文章的id号
		$art_id = $_GET['art_id'];
		// 实例化模型
		$article = Factory::M('ArticleModel');
		$result = $article->delArtById($art_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=index', ':( 发生未知错误,删除文章失败！');
		}
	}
	/**
	 * 根据id号批量删除文章
	 */
	public function delAllAction() {

		// 先判断用户是否选择了文章
		if(!isset($_POST['art_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Article&a=index', ':( 请先选择要删除的文章！');
		}
		// 获取要删除的所有文章的id号
		$art_ids = implode(',', $_POST['art_id']); //以逗号分隔，把所有值连在一起
		// 调用模型
		$article = Factory::M('ArticleModel');
		$result = $article->delAllArt($art_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=index', ':( 发生未知错误,删除文章失败！');
		}
	}
	/**
	 * 显示回收站信息动作 
	 */
	public function recycleAction() {
		// 调用模型,提取所有已经被逻辑删除的文章信息
		$article = Factory::M('ArticleModel');
		$artInfo = $article->getDelArt();
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = "index.php?p=Back&c=Article&a=recycle&";
		$rowCount = $article->getDelRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分配变量
		$this->assign('artInfo', $artInfo);
		// 输出视图文件
		$this->display('recycle.html');
	}
	/**
	 * 根据id号实现文章还原动作
	 */
	public function recoverAction() {
		//输出权限信息
        $this->printAuth('art_id','Article','recycle','id号还原','回收站列表');
		// 获取需要还原的文章的id号
		$art_id = $_GET['art_id'];
		// 调用模型
		$article = Factory::M('ArticleModel');
		$result = $article->recoverArtById($art_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=recycle', ':( 发生未知错误,还原文章失败！');
		}
	}
	/*
	*根据id号实现一键还原
	*/
	public function restoreAction() {

		//先判断用户是否选择了文章
		if(!isset($_POST['art_id'])) {
		   //说明没有选择文章
		   $this->jump('index.php?p=Back&c=Article&a=recycle',':( 请您选择需要还原的文章！');
		}
		//获取要还原的所有文章id号
		$art_ids = implode(',',$_POST['art_id']);
		//调用模型
		$article = Factory::M('ArticleModel');
		$result = $article->restoreArt($art_ids);
		if($result){
		    $this->jump('index.php?p=Back&c=Article&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=recycle',':( 一键还原文章失败！');
		}
		
	}
	/**
	 * 根据id号实现文章彻底删除动作
	 */
	public function realDelAction() {
		//输出权限信息
        $this->printAuth('art_id','Article','recycle','id彻底删除','回收站列表');
		// 要获取要删除的文章的id号
		$art_id = $_GET['art_id'];
		// 实例化模型
		$article = Factory::M('ArticleModel');
		//原图的信息
		$del_thumb=$article->getArtInfoById($art_id);
        $thumb=$del_thumb['thumb'];
		$first_thumb=$del_thumb['first_thumb'];
		$result = $article->realDelArtById($art_id);
		if($result) {
			if($thumb != 'default.jpg') {
			unlink(UPLOADS_DIR . 'thumb/' . $thumb); //删除缩略图 (垃圾回收)
			unlink(UPLOADS_DIR . 'thumb/' . $first_thumb); //删除原图
			}
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=recycle', ':( 发生未知错误,彻底删除文章失败！');
		}
	}
	/**
	 * 根据id号实现批量彻底删除文章动作
	 */
	public function realDelAllAction() {

		// 先判断用户是否选择了文章
		if(!isset($_POST['art_id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Article&a=recycle', ':( 请先选择要删除的文章！');
		}
		// 获取要彻底删除的所有文章的id号
		$art_ids = implode(',', $_POST['art_id']);
		// 调用模型
		$article = Factory::M('ArticleModel');
		//原图的信息
		$result = $article->realDelAllArt($art_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Article&a=recycle', ':( 发生未知错误,彻底删除文章失败！');
		}
	}
	/**
	 * 文章推荐的动作
	 */
	public function ifRecommendAction() {
		//输出权限信息
        $this->printAuth('art_id','Article','index','是否推荐','文章列表');
		// 接收文章编号
		$art_id = $_GET['art_id'];
		// 接收推荐状态
		$is_recommend = $_GET['is_recommend'];
		// 接收当前页码
		$pageNum = $_GET['pageNum'];
		// 调用模型
		$article = Factory::M('ArticleModel');
		$result = $article->updateRecommendById($art_id, $is_recommend);
		if($result) {
			$this->jump("index.php?p=Back&c=Article&a=index&pageNum=$pageNum");
		}else {
			$this->jump("index.php?p=Back&c=Article&a=index&pageNum=$pageNum", '发生未知错误,推荐文章失败!');
		}
	}
}


