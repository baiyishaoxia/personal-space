<?php

/**
 * DAO层操作接口
 */
interface I_DAO {
	public static function getInstance($config);
	public function my_query($sql);
	public function fetchAll($sql);
	public function fetchRow($sql);
	public function fetchColumn($sql);
}