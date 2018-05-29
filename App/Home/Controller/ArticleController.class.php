<?php

/**
 * 前台文章管理控制器
 */
class ArticleController extends PlatformController {

	/**
	 * 栏目首页动作
	 */
	public function indexAction() {
            // 接收栏目编号(主类别编号)
            $cate_id = $_GET['cate_id'];
            // 获取该栏目(主类别)下所有的文章信息
            $article = Factory::M('ArticleModel');
            $artInfo = $article->getArtInfo($cate_id);
            // 分配变量
            $this->assign('artInfo', $artInfo);
	    // 以下代码与分页有关
	    // 获取该分类下所有文章的总记录数
	    $rowCount = $article->getRowCount($cate_id);
	    $maxNum = $GLOBALS['conf']['Page']['maxNum'];
	    $url = "index.php?p=Home&c=Article&a=index&cate_id=$cate_id&";
	    // 实例化分页类
	    $HomeRowPage=$GLOBALS['conf']['Page']['HomeRowPage'];  //前台每页显示数
	    $page = new Page($HomeRowPage, $rowCount, $maxNum, $url);
	    // 获取页码字符串
	    $strPage = $page->getStrPage();
	    // 分配页码字符串
	    $this->assign('strPage', $strPage);
		// 分页到此结束
	    // 调用公共动作
	    $this->PublicAction($cate_id);
		//获取文章所属分类
		$category = Factory::M('CategoryModel');
        $Cateindex = $category->getCateindex($cate_id);
		if($Cateindex){
		  $this->jump("index.php?p=Home&c=Article&a=index&cate_id='$cate_id'");
		}
		// 加载视图文件
		$this->display('index.html');
	}

    /**
	* 传入日期格式或时间戳格式时间，返回与当前时间的差距，如1分钟前，2小时前，5月前，3年前等
	* @param string or int $date 分两种日期格式"2017-09-11 14:16:12"或时间戳格式"1386743303"
	* @param int $type
	* @return string
	*/
private function format_date($time){  
    $t=time()-$time;  
    $f=array(  
        '31536000'=>'年',  
        '2592000'=>'个月',  
        '604800'=>'星期',  
        '86400'=>'天',  
        '3600'=>'小时',  
        '60'=>'分钟',  
        '1'=>'秒'  
    );  
    foreach ($f as $k=>$v)    {  
        if (0 !=$c=floor($t/(int)$k)) {  
            return $c.$v.'前';  
        }  
     }  
   }
   //测试时间函数  
    public function format_dateAction(){
    	echo $this->format_date(1404600000);
    } 


	/**
	 * 公共动作 (顶级类别下的文章页动作)
	 */
	private function PublicAction($cate_id) {
		// 获取当前类别的一层子类别的信息
		$category = Factory::M('CategoryModel');
		$subCate = $category->getSubCateByPid($cate_id);
		// 分配变量
		$this->assign('subCate', $subCate);
		// 获取面包屑导航数组信息
		$article = Factory::M('ArticleModel');
		$list = $article->getAllCateName($cate_id);
		// 分配变量
		$this->assign('list', $list);
		// 获取当前分类下点击排行文章
		$maxsortByHits=$GLOBALS['conf']['Home']['maxsortByHits'];
		$sortByHits = $article->getSortByHits($cate_id, $maxsortByHits);
		$this->assign('sortByHits', $sortByHits);
		// 获取当前分类下推荐文章
		$maxrecommend=$GLOBALS['conf']['Home']['maxrecommend'];
		$sortByRecommend = $article->getSortByRecommend($cate_id, $maxrecommend);
		$this->assign('sortByRecommend', $sortByRecommend);
		//获取最新评论
		$replyById=$article->getSortByReply(5);
		//显示天数
		for($i=0;$i<count($replyById);$i++){
			//解决与本地相差8小时的问题
			if(date_default_timezone_get() != "1Asia/Shanghai") 
			   date_default_timezone_set("Asia/Shanghai");
			//加入属性(日期格式和分钟/小时/天/周/月/年前)
	        $replyById[$i]['y-m-d'] = date('Y-m-d H:i:s',$replyById[$i]['cmt_time']);
			$replyById[$i]['format_date'] = $this->format_date($replyById[$i]['cmt_time']);
	    }
        //var_dump($replyById);die;
        $this->assign('replyById', $replyById);

		//获取最近访客【完善】
		$user = Factory::M('UserModel');
		$laterUser = $user->latervisiter();
	    $this->assign('laterUser', $laterUser);
	}
	/**
	 * 显示文章内容页动作
	 */
	public function showAction() {
		// 接收当前文章的id号
		$art_id = $_GET['art_id'];
		// 调用模型,提取当前文章的信息
		$article = Factory::M('ArticleModel');
		// 在获取文章信息之前更新浏览次数
		$article->updateHitsById($art_id);
		// 通过id号获取文章信息
		$artInfoById = $article->getArtInfoById($art_id);

        //智能过滤
		$table_change = array('法轮大法好'=>'***','卧槽'=>'***','尼玛'=>'***','滚开'=>'***',
                              '杀死'=>'***','日狗了'=>'***'
	                         );
		$s = strtr($artInfoById['content'],$table_change);
		$artInfoById['content'] = $s;
		//过滤结束

		// 分配变量
		$this->assign('artInfoById', $artInfoById);
		// 获取当前文章的ID号(当前文章所属分类的id)
		$cate_id = $artInfoById['cate_id'];
		// 调用公共动作
		$this->PublicAction($cate_id);
		// 获取文章的上一篇与下一篇信息
		$prev = $article->getPrevArt($art_id, $cate_id);
		$next = $article->getNextArt($art_id, $cate_id);
		$this->assign('prev', $prev);
		$this->assign('next', $next);
		// 以下代码与分页有关
		$rowsPerPage = 5;
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = "index.php?p=Home&c=Article&a=show&art_id=$art_id&";
		$comment = Factory::M('CommentModel');
		$rowCount = $comment->getRowCountById($art_id);
		// 实例化分类页
		$page = new Page($rowsPerPage, $rowCount, $maxNum, $url);
		$strPage = $page->getStrPage();
		// 分配页码字符串
		$this->assign('strPage', $strPage);
		// 分页到此结束
		// 提取当前页所有评论
		$cmtInfos = $comment->getCmtInfosById($art_id, $rowsPerPage);


        //智能过滤
		$table_change = array('法轮大法好'=>'***','卧槽'=>'***','尼玛'=>'***','滚开'=>'***',
                              '杀死'=>'***','日狗了'=>'***'
	                         );
		foreach ($cmtInfos as $key => $value) {
		  $s = strtr($cmtInfos[$key]['cmt_content'],$table_change);
		  $cmtInfos[$key]['cmt_content'] = $s;
	    }
		//过滤结束
		
		// 分配变量
		$this->assign('cmtInfos', $cmtInfos);

		// 输出视图
		$this->display('show.html');
	}
	/**
	 * 处理评论动作
	 */
	public function commentAction() {
		// 先判断用户是否登录
		if(!isset($_SESSION['user_info'])) {
			$this->jump('index.php?p=Home&c=User&a=login', ':( 请您先登录！');
		}
		// 接收数据
		$cmtInfo = array();
		$cmtInfo['art_id'] = $_POST['art_id'];
		$cmt_content = $this->escapeData($_POST['content']);
		if(empty($cmt_content)) {
			$this->jump("index.php?p=Home&c=Article&a=show&art_id={$cmtInfo['art_id']}", ':( 内容不能为空！');
		}
		$cmtInfo['cmt_content'] = $cmt_content;
		$cmtInfo['cmt_time'] = time();
		$cmtInfo['cmt_user'] = $_SESSION['user_info']['user_name'];
		// 调用模型,入库
		$comment = Factory::M('CommentModel');
		if($comment->insertComment($cmtInfo)) {
			// 给当前文章的评论数加1
			$article = Factory::M('ArticleModel');
			$article->updateReplyNumsById($cmtInfo['art_id']);
			// 跳转到该文章的内容页
			$this->jump("index.php?p=Home&c=Article&a=show&art_id={$cmtInfo['art_id']}");
		}else {
			$this->jump("index.php?p=Home&c=Article&a=show&art_id={$cmtInfo['art_id']}", ':( 发生未知错误,发布失败！');
		}
	}

	public function escapeString($str) {
		return addslashes(strip_tags(trim($str)));  //去两边空格、标签、加转义(防止注入、恶意攻击)
	}
    //处理整站搜索逻辑
    public function searchAction() {
	   //接收数据
       $keyword = isset($_POST['keyword'])?$this->escapeString($_POST['keyword']):$_GET['keyword'];
       define("KEYWORD", $keyword);
       //实例化
       $search = Factory::M('ArticleModel');
       //获取结果
       //$searchContent = $search->getContentSearch($keyword);
       $content = $search->getPageSearch($keyword);
      // var_dump($content);
        // 以下代码与分页有关
	    // 获取搜索的所有文章的总记录数
        $count = $search->getSumSearch($keyword);
	    $maxNum = $GLOBALS['conf']['Page']['maxNum'];
	    $url = "index.php?p=Home&c=Article&a=search&keyword={$keyword}&";
	    // 实例化分页类
		$HomeRowPage=$GLOBALS['conf']['Page']['HomeRowPage'];  //前台每页显示数
	    $page = new Page($HomeRowPage, $count, $maxNum, $url);
	    // 获取页码字符串
	    $strPage = $page->getStrPage();
	    // 分配页码字符串
	    $this->assign('strPage', $strPage);
		// 分页到此结束
       $this->assign('keyword', $keyword);
       $this->assign('content', $content);
       $this->assign('strPage', $strPage); 
		// 调用MasterModel获取站长信息
	   $master = Factory::M('MasterModel');
	   $masterInfo = $master->getMasterInfo();
	    // 分配变量
	   $this->assign('masterInfo', $masterInfo);
       $this->display('search.html');
	}
        
        /*
         * 用户详情
         */
        public function usershowAction(){
           $user_id = $this->escapeString(isset($_GET['user_id'])?$_GET['user_id']:'') ;
           $user = Factory::M('UserModel');
           $usermassage = $user->usermessage($user_id);
           //获取最近访客【完善】
           $laterUser = $user->latervisiter();
	       $this->assign('laterUser', $laterUser);
           $this->assign('usermassage', $usermassage);
           $this->display('user_show.html');
        }
        
}

