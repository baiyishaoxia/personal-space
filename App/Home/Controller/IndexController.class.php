<?php

/**
 * 前台首页控制器
 */
class IndexController extends PlatformController {
	public function IndexAction() {
		// 调用Article模型
		$article = Factory::M('ArticleModel');
		// 获取推荐文章信息
		$maxrecommend = $GLOBALS['conf']['Home']['maxrecommend'];
		$recommendArt = $article->getRecommendArt($maxrecommend);
        
        //智能过滤
		$table_change = array('法轮大法好'=>'***','卧槽'=>'***','尼玛'=>'***','滚开'=>'***',
                              '杀死'=>'***'
	                         );
		foreach ($recommendArt as $key => $value) {
			$s = strtr($recommendArt[$key]['content'],$table_change);
			$recommendArt[$key]['content'] = $s;
		}
		

		// 分配变量
		$this->assign('recommendArt', $recommendArt);
		// 调用MasterModel获取站长信息
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		// 分配变量
		$this->assign('masterInfo', $masterInfo);
		// 获取最新文章列表(右侧)
		$maxnewArt = $GLOBALS['conf']['Home']['maxnewArt'];
		$newArt = $article->getNewArt($maxnewArt);
		// 分配变量
		$this->assign('newArt', $newArt);
		// 获取最热推荐文章列表(右侧)
		$maxArtByHits = $GLOBALS['conf']['Home']['maxArtByHits'];
		$rmdArtByHits = $article->getRmdArtByHits($maxArtByHits);
		// 分配变量
		$this->assign('rmdArtByHits', $rmdArtByHits);
        // 调用FriendshipModel获取友情链接信息
		$friend = Factory::M('FriendshipModel');
		$friendInfo = $friend->getfrdInfo();
		// 分配变量
		$this->assign('friendInfo', $friendInfo);
		//获取Banner应用信息
		$bannerInfo = $article->getBanner();
		$this->assign('bannerInfo', $bannerInfo);
		// 显示输出视图文件
		$this->display('index.html');
	}
}