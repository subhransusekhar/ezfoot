<?php
class Controller extends Uri {
	var $view = null;
	var $var = array();
	var $template = false;
	var $buffered = false;
	var $msg = "";
	var $format = '<div style="text-align: center;"><h3>{{MSG}}</h3></div>';
	var $replace = '{{MSG}}';
	var $site_title;
	function Controller(){
		parent::Uri();
	}
	function doBefore(){
	}
	function doDefault(){
	}
	function doAfter(){
	}
	function getOutputBufferState(){
		return OUTPUT_BUFFER_STATE;
	}
	function isControllerPresent($contoller){
		if($contoller==""){
			return false;
		} else if(file_exists(CONTROLLERS_PATH.'/'.$contoller.".php")) {
			return true;
		} else {
			return false;
		}
	}
	function isAjax(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			return true;
		}
		return false;
	}
	function setView($view,$template = false){
		if($view==""){
			$view = 'index';
		}
		$this->template = $template;
		$this->view = $view;
	}
	function getView(){
		return $this->view;
	}
	function addVar($name,$value){
		//$var = array($name => $value);
		$this->var[$name] = $value;
	}
	function extractVar(){
		extract($this->var);
	}
	function showView(){
		$filenPath = VIEWS_PATH.'/'.$this->view.".html";
		if(file_exists($filenPath)) {
			extract($this->var);
			if($this->template){
				$uri_array = $this->getUriArray();
        
		        $view_template_file = ""; 
		        
		        foreach($uri_array as $u){
		        	if(strtolower($u) == "" ){
		        		$view_template_file = "index";
		        	} else {
		        		$view_template_file .= "-".strtolower($u);
		        		$view_template_file  = trim($view_template_file,"-");
		        	}
		        	if(file_exists(TEMPLATES_PATH."/".TEMPLATE_NAME."/$view_template_file.tpl.php")) {
						$view_template_file_path = TEMPLATES_PATH."/".TEMPLATE_NAME."/$view_template_file.tpl.php";
		        	} 
		        }
		        
				if(file_exists($view_template_file_path)) {
					include($view_template_file_path);
				} else {
					include(TEMPLATES_PATH."/".TEMPLATE_NAME."/view.tpl.php");
				}
			} else {
				include($filenPath);
			}
		} else {
			die("View not found!");
		}
	}
	function printArray($var){
		if(is_array($var)){
			echo "<pre>".print_r($var,true)."</pre>";
		}
	}

	function addScript($path) {
		if($path!="" && $this->getOutputBufferState()) {
			$script = "<script type=\"text/javascript\" src=\"$path\"></script>";

			preg_match(HEAD_REPLACING_PATTERN_FROM, HEAD_REPLACING_CODE_FROM, $replacing_item);

			echo str_replace($replacing_item[1], $script, HEAD_REPLACING_CODE_FROM);
		}
	}
	function addCSS($path) {
		if($path!="" && $this->getOutputBufferState() ) {
			$css = "<link href=\"$path\" rel=\"stylesheet\" type=\"text/css\" />";

			preg_match(HEAD_REPLACING_PATTERN_FROM, HEAD_REPLACING_CODE_FROM, $replacing_item);

			echo str_replace($replacing_item[1], $css, HEAD_REPLACING_CODE_FROM);
		}
	}
	 
	function setSessionMsg($msg){
		$_SESSION['msg'] = $msg;
	}

	function printMsg(){
		$msg = $_SESSION['msg'];

		unset($_SESSION['msg']);

		$msg = str_replace($this->replace, $msg, $this->format);

		echo $msg;
	}

	function getBlock($view){
		$filenPath = VIEWS_PATH.'/'.$view.".html";
		if(file_exists($filenPath)) {
			extract($this->var);
			$this->template = fasle;
			$this->view = null;
			ob_start();
			include($filenPath);
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
		return false;
	}
	
	function getViewPart($view, $var = null){
		$filenPath = VIEWS_PATH.'/'.$view.".html";
		if(file_exists($filenPath)) {
			if(!empty($var ))
				extract($var);
			include($filenPath);
		}
	}
	function assign_rand_value($num, $alfanum = false)
	{
		if($alfanum){
			// accepts 1 - 36
			switch($num)
			{
				case "1":
					$rand_value = "a";
					break;
				case "2":
					$rand_value = "b";
					break;
				case "3":
					$rand_value = "c";
					break;
				case "4":
					$rand_value = "d";
					break;
				case "5":
					$rand_value = "e";
					break;
				case "6":
					$rand_value = "f";
					break;
				case "7":
					$rand_value = "g";
					break;
				case "8":
					$rand_value = "h";
					break;
				case "9":
					$rand_value = "i";
					break;
				case "10":
					$rand_value = "j";
					break;
				case "11":
					$rand_value = "k";
					break;
				case "12":
					$rand_value = "l";
					break;
				case "13":
					$rand_value = "m";
					break;
				case "14":
					$rand_value = "n";
					break;
				case "15":
					$rand_value = "o";
					break;
				case "16":
					$rand_value = "p";
					break;
				case "17":
					$rand_value = "q";
					break;
				case "18":
					$rand_value = "r";
					break;
				case "19":
					$rand_value = "s";
					break;
				case "20":
					$rand_value = "t";
					break;
				case "21":
					$rand_value = "u";
					break;
				case "22":
					$rand_value = "v";
					break;
				case "23":
					$rand_value = "w";
					break;
				case "24":
					$rand_value = "x";
					break;
				case "25":
					$rand_value = "y";
					break;
				case "26":
					$rand_value = "z";
					break;
				case "27":
					$rand_value = "0";
					break;
				case "28":
					$rand_value = "1";
					break;
				case "29":
					$rand_value = "2";
					break;
				case "30":
					$rand_value = "3";
					break;
				case "31":
					$rand_value = "4";
					break;
				case "32":
					$rand_value = "5";
					break;
				case "33":
					$rand_value = "6";
					break;
				case "34":
					$rand_value = "7";
					break;
				case "35":
					$rand_value = "8";
					break;
				case "36":
					$rand_value = "9";
					break;
			}
		} else {
			switch ($num){
				case "1":
					$rand_value = "0";
					break;
				case "2":
					$rand_value = "1";
					break;
				case "3":
					$rand_value = "2";
					break;
				case "4":
					$rand_value = "3";
					break;
				case "5":
					$rand_value = "4";
					break;
				case "6":
					$rand_value = "5";
					break;
				case "7":
					$rand_value = "6";
					break;
				case "8":
					$rand_value = "7";
					break;
				case "9":
					$rand_value = "8";
					break;
				case "10":
					$rand_value = "9";
					break;
			}
		}
		return $rand_value;
	}
	function get_rand_id($length,$alfanum = false)
	{
		if($length>0)
		{
			$rand_id="";
			for($i=1; $i<=$length; $i++)
			{
				mt_srand((double)microtime() * 1000000);
				if($alfanum){
					$num = mt_rand(1,36);
				} else{
					$num = mt_rand(1,10);
				}
				$rand_id .= $this->assign_rand_value($num,$alfanum);
			}
		}
		return $rand_id;
	}
	
	function doAction($action){
		global $actionObjs;
		if(!empty($actionObjs[$action])){
			foreach($actionObjs[$action] as $function){
				call_user_func($function);
			}
		}
	}

	function addAction($action, $fun){
		global $actionObjs;
		 
		$actionObjs[$action][] = $fun;
		 
	}
	

	function showDebug(){
		if($_REQUEST['debug']) {
			echo '<div id="debug-wrapper">';
			$this->doAction("action_debug");
			echo '<div id="debug-wrapper">';
		} 
	}
	
	function generateUrl($path, $param = null, $print = false){
		$url = SITE_URL_LINK.$path;	
		
		if($param) {
			$url .= "?";
			$par = "";
			foreach($param as $index=>$value){
				$par .= "&$index=$value";
			}
			$par = trim($par, "&");
			$url .= $par;
		}
		if($print)
			echo $url;
		else		
			return $url;
	}
	
	function checkCurrentPagePrint($reqArr, $printText = null) {
		$uri = $this->getUriArray();
		
		if( is_array($reqArr) && count($reqArr) > 0 && count($uri) > 0){
			for($i= 0 ;$i < count($reqArr);$i++ ) {
				if($reqArr[$i] != $uri[$i]) return false;
			}
		} else if($reqArr[0] != "index" ) {
			return false;
		}
		
		if($printText){
				echo $printText;
		} else {
			return true;
		}
	}
	
}