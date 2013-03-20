<?php

/**
 * 全局设定
 * @author fotomxq <fotomxq.me>
 * @version 5
 * @package Core
 */
/**
 * 相对路径定义
 * @since 1
 */
define('DS', '/');
define('DIR_LIB', 'includes');
define('DIR_DATA', 'content');

/**
 * 设定时区
 * @since 2
 */
date_default_timezone_set('PRC');

/**
 * 开启会话
 * @since 4
 */
@session_start();

/**
 * 网站测试开关
 * @since 2
 */
define('SYS_DEBUG', true);

/**
 * 引入数据库定义
 * @since 1
 */
require(DIR_DATA . DS . 'configs' . DS . 'db.inc.php');

/**
 * 引入错误处理模块
 * @since 3
 */
require(DIR_LIB . DS . 'core-error.php');

/**
 * 引入并初始化数据库连接<br/>
 * 保留$db变量用于后面使用
 * @since 2
 */
require(DIR_LIB . DS . 'core-db.php');
$db = new coredb($db_dns, $db_username, $db_password, $db_persistent);
$db->set_encoding($db_encoding);

/**
 * 初始化配置操作句柄
 * @since 4
 */
require(DIR_LIB . DS . 'oa-configs.php');
$oaconfig = new oaconfigs($db);

/**
 * 初始化IP地址
 * @since 4
 */
require(DIR_LIB . DS . 'core-ip.php');
$coreip = new coreip(DIR_DATA . DS . 'configs' . DS . 'qqwry.dat', $db);
$ip_arr = $coreip->get_ip();

/**
 * 初始化日志操作
 * @since 4
 */
require(DIR_LIB . DS . 'core-log.php');
$log = new corelog($ip_arr['addr'], $db, true);

/**
 * 获取页面基本配置内容
 * @since 2
 */
$website_title = $oaconfig->load('WEB_TITLE');

require(DIR_LIB.DS.'oa-user.php');
$oauser = new oauser($db);
echo $oauser->login('oasysadmin', 'adminadmin', 1);
//echo $oauser->status(1);
?>
