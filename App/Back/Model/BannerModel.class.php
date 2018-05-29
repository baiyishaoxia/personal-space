<?php

/**
 * 后台bg_banner表操作模型
 */
class BannerModel extends Model {

	/**
	 * 获取所有Banner信息
	 */
	public function getBanner() {
        $pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
        $rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
        $offset = ($pageNum - 1) * $rowsPerPage;  //偏移量
        //查询(is_del是逻辑上删除的一个标志)
		$sql = "select * from bg_banner where is_del='0' order by addtime desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
	}

	/**
	 * 获取总记录数
	 */
    public function getRowCount(){

    	$sql = "select count(*) from bg_banner where is_del='0'";
    	return $this->dao->fetchColumn($sql);
    }
   
    /**
     * Banner添加入库操作
     */
    public function insertBanner($bannerInfo){
        extract($bannerInfo);
        $addtime = time();
        $sql = "insert into bg_banner values (null,'$banner_title','$banner_img','$picture',default,default,$addtime)";
    	return $this->dao->my_query($sql);
    }

    /**
     * 是否应用切换操作
     */
    public function updateRecommendById($banner_id, $is_recommend){
    	if($is_recommend == '0') {
			$is_recommend = '1';
		}else {
			$is_recommend = '0';
		}
		$sql = "update bg_banner set is_recommend = '$is_recommend' where id=$banner_id";
		return $this->dao->my_query($sql);
    }

    /**
     * 根据banner_id获取需要修改的信息
     */
    public function getBannerInfoById($banner_id){
    	$sql = "select * from bg_banner where id=$banner_id";
		return $this->dao->fetchRow($sql);
    }

    /**
     * 处理需要修该的Banner信息
     */
    public function UpdateBannerById($bannerInfo){
    	extract($bannerInfo);
		$sql = "update bg_banner set title='$title',img='$img',picture='$picture' where id=$banner_id";
		return $this->dao->my_query($sql);
    }

    /**
     * 根据id删除单个banner操作
     */
    public function delBannerById($banner_id){
       $sql = "update bg_banner set is_del='1' where id=$banner_id";
		return $this->dao->my_query($sql);
    }
    /**
     * 获取逻辑删除信息
     */
    public function getDelBanner(){
		$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$offset = ($pageNum - 1) * $rowsPerPage;
		$sql = "select * from bg_banner where is_del='1' order by addtime desc limit $offset,$rowsPerPage";
		return $this->dao->fetchAll($sql);
    }
    /**
     * 获取逻辑删除后的总记录数
     */
    public function getDelRowCount(){
		$sql = "select count(*) from bg_banner where is_del='1'";
		return $this->dao->fetchColumn($sql);
    }
    /**
     * 批量逻辑删除
     */
    public function delAllBanner($banner_ids){
    	$sql = "update bg_banner set is_del='1' where id in($banner_ids)";
		return $this->dao->my_query($sql);
    }
    /**
     * 一键还原
     */
    public function restoreBanner($banner_ids){
    	$sql = "update bg_banner set is_del='0' where id in ($banner_ids)";
		return $this->dao->my_query($sql);
    }
    /**
     * 批量彻底删除操作
     */
    public function realDelAllBanner($banner_ids){
		$sql = "delete from bg_banner where id in($banner_ids)";
		return $this->dao->my_query($sql);	
    }
}