<?php

/**
 * 后台bg_auth表操作模型
 */
class AuthManagerModel extends Model {
	/**
	 * 获取管理员信息
	 */
	public function find($admin_id) {
		$sql = "select * from bg_admin where admin_id='$admin_id'";
		return $this->dao->fetchRow($sql);
	}
	//根据管理员ad_role_id获取角色信息
	public function getAdminRole($role_id){
		$sql = "select * from bg_role where role_id='$role_id'";
		return $this->dao->fetchRow($sql);
	}
    //获取角色信息
	public function findRoleId($role_id){
		$sql = "select * from bg_role where role_id='$role_id'";
		return $this->dao->fetchAll($sql);
	}
	//修改角色信息
	public function updateRole($role_id,$role_name){
		$sql = "update bg_role set role_name = '$role_name' where role_id='$role_id'";
		return $this->dao->my_query($sql);
	}
	//添加角色信息
	public function addRole($role_name){
		$sql = "insert into bg_role values (null, '$role_name', default, 'Category-index')";
		return $this->dao->my_query($sql);
	}
    //获取角色的权限信息
	public function selectRoleIds($auth_ids){
		$sql = "select * from bg_auth where auth_id in($auth_ids)";
		return $this->dao->fetchAll($sql);
	}
	//根据角色表中auth_ids获取权限表中的(c+a)信息
	private function selectAuth($auth_ids){
		$sql = "select * from bg_auth where auth_id in($auth_ids)";
		return $this->dao->fetchAll($sql);
	}
	//获取角色的权限信息(level=0父级level=1子级)
	public function selectLevel($auth_ids,$level,$leve=0){
		if(empty($leve)){
			$sql = "select * from bg_auth where auth_level='$level' and auth_id in($auth_ids) ";
		    return $this->dao->fetchAll($sql);
		}else{
			$sql = "select * from bg_auth where (auth_level='$level' and auth_id in($auth_ids)) or (auth_level='$leve' and auth_id in($auth_ids)) order by auth_path";
		    return $this->dao->fetchAll($sql);
		}
	}
	//获取角色的权限信息(超级管理员不受限制)
	public function selectAdminLevel($level,$leve=0){
		if(empty($leve)){
			$sql = "select * from bg_auth where auth_level='$level'";
		    return $this->dao->fetchAll($sql);
		}else{
			$sql = "select * from bg_auth where auth_level='$level' or auth_level='$leve' order by auth_path";
		    return $this->dao->fetchAll($sql);
		}
    }
    //获取所有管理员信息
    public function getAdminInfo(){
			$sql = "select * from bg_admin as a  left join bg_role as b on a.ad_role_id = b.role_id order by a.admin_id";
		    return $this->dao->fetchAll($sql);
    }
    //获取具体管理员信息
    public function getAdminInfobyId($admin_id){
			$sql = "select * from bg_admin where admin_id='$admin_id'";
		    return $this->dao->fetchRow($sql);
    }
    //更改管理员信息
    public function updateAdminInfo($admin,$admin_id){
    	    extract($admin);
           $sql = "update bg_admin set admin_name = '$admin_name',admin_pass='$admin_pass',ad_role_id = '$ad_role_id' where admin_id='$admin_id'";
           return $this->dao->my_query($sql);
    }
    //获取所有角色信息
    public function getRoleInfo(){
			$sql = "select * from bg_role";
		    return $this->dao->fetchAll($sql);
    }
    //获取当前角色的权限信息
    public function getRoleIdInfo($role_id){
			$sql = "select * from bg_role where role_id = '$role_id'";
		    return $this->dao->fetchRow($sql);
    }
    //为用户分配权限，制作数据，写入数据库
    public function saveAuth($role_id,$auth_id){
           //制作 role_auth_ids
           $auth_ids = implode(',',$auth_id);
           //var_dump($auth_ids);
           //制作 role_auth_ac (控制器+操作方法)
           //根据$authids查询每个权限的controller和action
           $authinfo = $this->selectAuth($auth_ids);
           $s="";
           foreach($authinfo as $k =>$v ){
           	  if(!empty($v['auth_c']) && !empty($v['auth_a']))
           	      $s .=$v['auth_c']."-".$v['auth_a'].",";
           }
           //去除最后的逗号
           $s = rtrim($s,',');
           //入库
           $sql = "update bg_role set role_auth_ids = '$auth_ids',role_auth_ac ='$s' where role_id='$role_id'";
           return $this->dao->my_query($sql);
    }
    //获取管理员对应的角色信息
    public function getRoleManage(){
    	   $sql = "select role_id,role_name from bg_role";
    	   return $this->dao->fetchAll($sql);

    }
    //添加管理员
    public function insertAdmin($admin){
    	extract($admin);
		// 完善其他数据表数据
		$login_time = time();
		// 入库
		$sql = "insert into bg_admin values (null, '$admin_name', '$admin_pass',default,default,'$login_time','$ad_role_id')";
		return $this->dao->my_query($sql);
    }
    //获取权限列表的总数,用于分页
    public function getAuthCount(){
    	$sql = "select count(*) from bg_auth";
    	return $this->dao->fetchColumn($sql);
    }

    //获取所有权限信息
    public function getAuthInfo(){
	     $pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
	     $rowsPerPage = 8;
	     $offset = ($pageNum - 1) * $rowsPerPage;  //偏移量
    	 //auth_path的作用是为了分清父子级的关系，为了排序较快的体现出来
    	 $sql = "select * from bg_auth order by auth_path limit $offset,$rowsPerPage";
    	 return $this->dao->fetchAll($sql);
    }
    //根据auth_pid查询本身的一条记录信息
    private function findAuthPid($auth_pid){
         $sql ="select * from bg_auth where auth_id = '$auth_pid'";
         return $this->dao->fetchRow($sql);
    }
    //根据auth_id获取本身权限信息
    public function selectAuthById($auth_id){
         $sql ="select * from bg_auth where auth_id = '$auth_id'";
         return $this->dao->fetchRow($sql);
    }

    //添加权限
    public function saveAuthData($data){
    	//思想：先根据已有信息插入形成一天新纪录，当path与level制作好了再进行更新到记录
    	$auth_name = $data['auth_name'];
    	$auth_pid = $data['auth_pid'];
    	$auth_c = $data['auth_c'];
    	$auth_a =$data['auth_a'];

    	//根据已有data生成一条数据
    	 $sql = "insert into bg_auth values (null,'$auth_name','$auth_pid','$auth_c','$auth_a',default,default)";
    	 $result = $this->dao->my_query($sql);
    	 if($result){
    	 	$sql2 = "select max(auth_id) from bg_auth";
            $newid = $this->dao->fetchColumn($sql2);
    	 }

    	//制作auth_path
    	//（顶级权限auth_pid = 生成的主键id 
    	if($auth_pid == 0){
    		$path = $newid;
    	}else{
    	//  非顶级 根据pid获取父级权限进而获其‘全路径’）形成 父级全路径-新纪录id值
    	    $pinfo = $this->findAuthPid($auth_pid);
    	    $path = $pinfo['auth_path']."-".$newid;
    	}
    	//echo $path;
    	
    	//制作auth_level
    	//全路径里面的'-'就是level的值
        $level = substr_count($path, '-');
        $sql = "update bg_auth set auth_path = '$path',auth_level = '$level' where auth_id = '$newid'";
        return $this->dao->my_query($sql);
    }
    //修改权限
    public function updateAuthData($data){
    	$auth_id   = $data['auth_id'];
        $auth_name = $data['auth_name'];
        $auth_pid =  $data['ad_role_id'];
        $auth_c   =  $data['auth_c'];
        $auth_a   =  $data['auth_a'];
        $auth_path =  $data['auth_path'];
        $auth_level =  $data['auth_level'];
        $sql = "update bg_auth set auth_name = '$auth_name',auth_pid = '$auth_pid',auth_c = '$auth_c',auth_a = '$auth_a',auth_path='$auth_path',auth_level='$auth_level' where auth_id = '$auth_id'";
        return $this->dao->my_query($sql);
    }
    //彻底删除管理员
    public function deleteAdmin($admin_id){
    	$sql = "delete from bg_admin where admin_id = $admin_id";
		return $this->dao->my_query($sql);
    }

    //彻底删除权限
    public function deleteAuth($auth_id){
    	$sql = "delete from bg_auth where auth_id = $auth_id";
		return $this->dao->my_query($sql);
    }
    //彻底批量删除权限
    public function delAllAuth($auth_ids){
		$sql = "delete from bg_auth where auth_id in($auth_ids)";
		return $this->dao->my_query($sql);
    }



}