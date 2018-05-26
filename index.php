<?php

/**
 * 引入项目初始化框架类
 */
include './Frame/Frame.class.php';
//设置中国时区
date_default_timezone_set('PRC');
// 调用run方法
Frame::run();
