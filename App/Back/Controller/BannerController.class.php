   <?php

    /**
     * 前台的Banner管理
     */
   class BannerController extends PlatformController { 
     
     //显示静态文件
     public function indexAction() {
     	// 实例化模型,提取所有的文章信息
		$banner = Factory::M('BannerModel');
		$bannerInfo = $banner->getBanner();
		// 分配变量
		$this->assign('bannerInfo', $bannerInfo);
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage']; //每页记录数
		$maxNum = $GLOBALS['conf']['Page']['maxNum']; //最大页码个数
		$url = "index.php?p=Back&c=Banner&a=index&";
		$rowCount = $banner->getRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分页到此结束
     	// 载入当前的视图文件
		$this->display('index.html');
     }

     //添加Banner的显示操作
     public function addAction(){
		// 输出视图文件
		$this->display('add.html');

     }

     //处理添加Banner操作
     public function dealAddAction(){
     	$bannerInfo = array();
     	// 接收表单
	    $bannerInfo['banner_title'] = addslashes($_POST['title']);

		// 判断数据合法性
		if(empty($bannerInfo['banner_title'])) {
			$this->jump('index.php?p=Back&c=Banner&a=add', ':( Banner内容不可以为空！');
		}

		// 判断是否有图片上传
		if($_FILES['banner']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'Banner';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['banner'], $allow, $path,3145728); //返回来的是新名字
			// 判断是否上传成功
			if($result) {
				// 生成缩略图
				$image = Factory::M('Image');
				$max_w = 715;
				$max_h = 290;
				$src_file = UPLOADS_DIR . 'banner/' . $result; //原图的路径
				if($banner = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
					$bannerInfo['banner_img'] = $banner;  //缩略图
				}else {
					$this->jump('index.php?p=Back&c=Banner&a=add', Image::$error);
				}
				$bannerInfo['picture']=$result; //原图
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump('index.php?p=Back&c=Banner&a=add', $error);
			}
		}else {
			$bannerInfo['banner_img'] = 'banner.jpg';  //默认缩略图
			$bannerInfo['picture']='banner.jpg'; //默认原图
		}
		// 调用模型,数据入库
		$banner = Factory::M('BannerModel');
		$result = $banner->insertBanner($bannerInfo);
		if($result) {
			$this->jump('index.php?p=Back&c=Banner&a=index',':) Banner添加成功');
		}else {
			$this->jump('index.php?p=Back&c=Banner&a=add', ':( 发生未知错误,Banner添加失败！');
		}
     }

    /**
	 * 是否应用banner的动作
	 */
	public function ifRecommendAction() {
		//输出权限信息
        $this->printAuth('banner_id','Banner','index','状态','Banner列表');
		// 接收文章编号
		$banner_id = $_GET['banner_id'];
		// 接收推荐状态
		$is_recommend = $_GET['is_recommend'];
		// 接收当前页码
		$pageNum = $_GET['pageNum'];
		// 调用模型
		$banner = Factory::M('BannerModel');
		$result = $banner->updateRecommendById($banner_id, $is_recommend);
		if($result) {
			$this->jump("index.php?p=Back&c=Banner&a=index&pageNum=$pageNum");
		}else {
			$this->jump("index.php?p=Back&c=Banner&a=index&pageNum=$pageNum", '发生未知错误,主题应用失败!');
		}
	}

	/**
	 * Banner修改的动作
	 */
	public function editAction(){
		//输出权限信息
        $this->printAuth('id','Banner','index','修改','Banner列表');
		// 接收banner的id号
		$banner_id = $_GET['id'];
		// 获取当前Banner的信息
		$banner = Factory::M('BannerModel');
		$bannerInfoById = $banner->getBannerInfoById($banner_id);
		// 分配变量
		$this->assign('bannerInfoById', $bannerInfoById);
		// 输出视图文件
		$this->display('edit.html');
	}

	/**
	 * 处理Banner修改的动作
	 */
	public function dealEditAction(){
		//接收数据
		$bannerInfo = array();
		$bannerInfo['banner_id'] = $_POST['banner_id'];
        $bannerInfo['img'] = $_POST['img'];
        $bannerInfo['picture']=$_POST['picture'];
        $bannerInfo['title']=addslashes($_POST['title']);
		// 判断数据合法性
		if(empty($bannerInfo['title'])) {
			$this->jump("index.php?p=Back&c=Banner&a=edit&id={$bannerInfo['banner_id']}", ':( 您填写的数据不完整');
		}
        // 判断是否有缩略图上传
		if($_FILES['banner']['error'] != 4) {
			// 说明用户选择了上传文件,实例化上传类
			$upload = Factory::M('Upload');
			// 初始化相关参数
			$allow = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
			$path = UPLOADS_DIR . 'Banner';
			// 调用uploadAction方法
			$result = $upload->uploadAction($_FILES['banner'], $allow, $path,3145728); //返回的新名字就是原图名
			// 判断是否上传成功
			if($result) {
				// 生成缩略图
				$image = Factory::M('Image');
				$max_w = 970;
				$max_h = 400;
				$src_file = UPLOADS_DIR . 'Banner/' . $result;
				if($banner = $image->makeThumb($max_w, $max_h, $src_file, $path)) {
					$bannerInfo['img'] = $banner;  //保存缩略图
				}else {
					$this->jump('index.php?p=Back&c=Banner&a=edit', Image::$error);
				}
				$bannerInfo['picture'] = $result; //保存原图
				//回收机制
				if($_POST['img'] != 'default.jpg') {
					    unlink(UPLOADS_DIR . 'Banner/' . $_POST['picture']); //删除原图 
						unlink(UPLOADS_DIR . 'Banner/' . $_POST['img']);  //删除缩略图
				}
			}else {
				// 记录错误信息并跳转
				$error = Upload::$error;
				$this->jump("index.php?p=Back&c=Banner&a=edit&id={$bannerInfo['banner_id']}", $error);
			}
		}else {
			$bannerInfo['img'] = $_POST['img']; // 以前的缩略图
		}
		// 调用模型,数据入库
		$banner = Factory::M('BannerModel');
		$result = $banner->UpdateBannerById($bannerInfo);
		if($result) {
			$this->jump('index.php?p=Back&c=Banner&a=index');
		}else {
			$this->jump("index.php?p=Back&c=Banner&a=edit&id={$bannerInfo['banner_id']}", ':( 发生未知错误,修改Banner失败！');
		}
	}

	/**
	 * Banner的单选删除操作
	 */
	public function delAction(){
		//输出权限信息
        $this->printAuth('id','Banner','index','删除','Banner列表');
		// 要获取要删除的Banner的id号
		$banner_id = $_GET['id'];
		// 实例化模型
		$banner = Factory::M('BannerModel');
		$result = $banner->delBannerById($banner_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Banner&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Banner&a=index', ':( 发生未知错误,删除Banner失败！');
		}
	}

	/**
	 * 设置回收站操作
	 */
	public function recycleAction(){
		// 调用模型,提取所有已经被逻辑删除的信息
		$banner = Factory::M('BannerModel');
		$bannerInfo = $banner->getDelBanner();
		// 以下代码与分页有关
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = "index.php?p=Back&c=Banner&a=recycle&";
		$rowCount = $banner->getDelRowCount(); // 获取总记录数
		// 实例化分页类
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分配变量
		$this->assign('bannerInfo', $bannerInfo);
		// 输出视图文件
		$this->display('recycle.html');
	}
	/**
	 * 批量删除操作
	 */
	public function delAllAction(){

		// 先判断用户是否选择了
		if(!isset($_POST['id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Banner&a=index', ':( 请先选择要删除的Banner！');
		}
		// 获取要删除的所有的id号
		$banner_ids = implode(',', $_POST['id']); //以逗号分隔，把所有值连在一起
		// 调用模型
		$banner = Factory::M('BannerModel');
		$result = $banner->delAllBanner($banner_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Banner&a=index');
		}else {
			$this->jump('index.php?p=Back&c=Banner&a=index', ':( 发生未知错误,删除Banner失败！');
		}
	}
	/**
	 * 一键还原操作
	 */
	public function restoreAction(){

		//先判断用户是否选择了
		if(!isset($_POST['id'])) {
		   //说明没有选择文章
		   $this->jump('index.php?p=Back&c=Banner&a=recycle',':( 请您选择需要还原的Banner！');
		}
		//获取要还原的所有文章id号
		$banner_ids = implode(',',$_POST['id']);
		//调用模型
		$banner = Factory::M('BannerModel');
		$result = $banner->restoreBanner($banner_ids);
		if($result){
		    $this->jump('index.php?p=Back&c=Banner&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Banner&a=recycle',':( 一键还原Banner失败！');
		}
	}
	/**
	 * 单个id还原操作
	 */
	public function recoverAction(){
		$this->jump('index.php?p=Back&c=Banner&a=recycle','此功能太过简单,暂未开放,请使用一键还原操作！');
	}
	/**
	 * 单个id删除操作
	 */
	public function realDelAction(){
		$this->jump('index.php?p=Back&c=Banner&a=recycle','此功能太过简单,暂未开放,请使用批量彻底删除操作！');
	}
	/**
	 * 根据id号实现批量彻底删除动作
	 */
	public function realDelAllAction() {

		// 先判断用户是否选择了文章
		if(!isset($_POST['id'])) {
			// 说明没有没有选择文章
			$this->jump('index.php?p=Back&c=Banner&a=recycle', ':( 请先选择要彻底删除的Banner！');
		}
		// 获取要彻底删除的所有文章的id号
		$banner_ids = implode(',', $_POST['id']);
		// 调用模型
		$banner = Factory::M('BannerModel');
		//已经被逻辑删除的信息
		$result = $banner->realDelAllBanner($banner_ids);
		if($result) {
			$this->jump('index.php?p=Back&c=Banner&a=recycle');
		}else {
			$this->jump('index.php?p=Back&c=Banner&a=recycle', ':( 发生未知错误,彻底删除Banner失败！');
		}
	}

}