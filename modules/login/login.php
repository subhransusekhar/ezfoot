<?php 
/*
 * Module Name: mod_login
 */


class Mod_Login extends Sql {
	
	var $module_name = "mod_login";
	
	var $table_name = "mod_user";
	
	var $user = null;
	
	function Mod_Login(){
		global $mod_login_page;
		$this->install();
		
		$mod_action = $_REQUEST['mod_login_action'];
		
		switch($mod_action) {
			case 'login':
				$this->login();
				break;
			case 'update':
				$this->updateUser($_REQUEST);
				break;
			case 'logout':
				$this->logout();
				break;
		}
		
		if(!$this->isLogin()) {
			$uri = new Uri();
			$url = trim(str_replace(ROOT_DIR,'',$uri->getUri(true)),'/' );
			
			if(in_array($url, $mod_login_page)){
				if(SESSION_AFTER_LOGIN_PATH != ""){
					$_SESSION[SESSION_AFTER_LOGIN_PATH] = $uri->getRequestUri();
				}
				if(USER_LOGIN_REDIRECTION != ""){
					header('Location: '.SITE_URL."".USER_LOGIN_REDIRECTION);
					die();
				}
			}
		}
		
	}
	
	function install() {
		$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->table_name.'` (
			`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`username` 		VARCHAR( 255 ) NOT NULL ,
			`password` 		VARCHAR( 255 ) NOT NULL,
			`email`			TEXT NULL ,
			`first_name` 	VARCHAR( 255 ) NULL ,
			`last_name`		VARCHAR( 255 ) NULL 
			)';
		
		$this->executeQuery($sql);
		
		$sql = 'SELECT * FROM `'.$this->table_name.'` WHERE id = 1 ';
		if(!$this->executeQuery($sql, 4)){
			$admin_sql = 'INSERT INTO `'.$this->table_name.'`(`id`, `username`, `password`) VALUES(1, \'admin\', \'21232f297a57a5a743894a0e4a801fc3\')';
			$this->executeQuery($admin_sql);
		}
	}
	
	
	function isLogin(){
		$ses_name = SESSION_NAME_USER;
		
		if(!empty($ses_name)):
			if(!empty($_SESSION[$ses_name])) return true;
		else
			if(!empty($_SESSION["USER_ID"])) return true;
		endif;		
		
		return false;
	}
	
	function setSession($id){
		$ses_name = SESSION_NAME_USER;
		
		if(!empty($ses_name)):
			$_SESSION[$ses_name] = $id;
		else:
			$_SESSION["USER_ID"] = $id;
		endif;		
	}
	
	function logout(){
		$ses_name = SESSION_NAME_USER;
		
		if(!empty($ses_name)):
			unset($_SESSION[$ses_name]);
		else:
			unset($_SESSION["USER_ID"]);
		endif;
		
		unset($_SESSION[SESSION_AFTER_LOGIN_PATH]);
		
		if(USER_LOGIN_REDIRECTION!=""){
			header('Location: '.SITE_URL.USER_LOGIN_REDIRECTION);
			die();
		}
	}
	
	function isLoginValid($username, $password){
		$sqlObj = new Sql();
		$sql = "SELECT * FROM " . $this->table_name . " 
				WHERE username = '$username'  
				AND password = '".md5($password)."' ";
		
		if($this->executeQuery($sql,4)) {
			$user = $this->executeQuery($sql,2);
			return $user['id'];
		}
		
		return false;
	}
	
	function login(){	
		if($user_id = $this->isLoginValid($_REQUEST['username'], $_REQUEST['password'])):
			$this->setSession($user_id);
			if(SESSION_AFTER_LOGIN_PATH != ""){
				if(isset($_SESSION[SESSION_AFTER_LOGIN_PATH])){
					header("Location: ".SITE_URL.$_SESSION[SESSION_AFTER_LOGIN_PATH]);
					unset($_SESSION[SESSION_AFTER_LOGIN_PATH]);
					die();
				}
			}
			
			if(USER_AFTER_LOGIN_PATH != ""){
				header("Location: ".SITE_URL.USER_AFTER_LOGIN_PATH);
				die();
			}
		endif;
	}
	
	function addUser($arg){
		if(empty($arg['username']))
			return false;
		if(empty($arg['password']))
			return false;
		
		$arg['password'] = md5($arg['password']);
			
		$sql = $this->createInsertQuery($this->table_name,$arg);
		$user_id = $this->executeQuery($sql,5);
		if(empty($user_id))
			return false;
		return $user_id; 
	}
	
	function updateUser($arg, $id = null){
		$sqlObj = new Sql();
		$argument = array(); 
		if($id == null ){
			$ses_name = SESSION_NAME_USER;
			
			if(!empty($ses_name)):
				$id = $_SESSION[$ses_name];
			else:
				$id = $_SESSION["USER_ID"] ;
			endif;
		}
		
		if(empty($id))
			return false;
		
		if(!empty($arg['password']))
			$argument['password'] = "'".md5($arg['password'])."'";
		
		if(!empty($arg['email']))
			$argument['email'] = "'".$arg['email']."'";
			
		if(!empty($arg['first_name']))
			$argument['first_name'] = "'".$arg['first_name']."'";
		
		if(!empty($arg['last_name']))
			$argument['last_name'] = "'".$arg['last_name']."'";
		
		$conditon = array('id' => $id);
		
		$sql = $this->createUpdateQuery($this->table_name, $argument, $conditon);
		
		$sqlObj->executeQuery($sql,5);
		
		return true; 
	}
	
	function getCurrentUsername(){
		$ses_name = SESSION_NAME_USER;
		
		if(!empty($ses_name)):
			$id = $_SESSION[$ses_name];
		else:
			$id = $_SESSION["USER_ID"] ;
		endif;	
		
		if( $user = $this->getUser($id) )
			return $user['username'];

		return false;
	}
	
	function getCurrentUser(){
		$ses_name = SESSION_NAME_USER;
		
		if(!empty($ses_name)):
			$id = $_SESSION[$ses_name];
		else:
			$id = $_SESSION["USER_ID"] ;
		endif;	
		
		if( $user = $this->getUser($id) )
			return $user;

		return false;
	}
	
	function getUser($id){
		$sql = "SELECT * FROM " . $this->table_name . " 
				WHERE id = '$id' ";
		if($this->executeQuery($sql,4)) {
			$user = $this->executeQuery($sql,2);
			return $user;
		}
		
		return false;
	}
}