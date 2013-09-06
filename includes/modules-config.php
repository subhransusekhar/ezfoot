<?php
global $moduleObjs;
global $mod_login_page;

$moduleObjs = array();
$mod_login_page = array('account/index', 'account', 'account/urllist', 'account/account');

define( 'SESSION_NAME_USER', 'USER_ID');
define( 'SESSION_AFTER_LOGIN_PATH', 'AFTER_LOGIN_PATH');
define( 'USER_LOGIN_VIEW', 'account/login' );
define( 'USER_LOGIN_REDIRECTION', 'account/login' );
define( 'USER_AFTER_LOGIN_PATH', 'account/index');