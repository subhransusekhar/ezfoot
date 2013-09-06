<?php
/*
* ezFoot engine class
*/
class Init extends Uri{
	var $output;
    function Init(){
        parent::Uri();
        $this->setController($this->getUri());
    }
    function isControllerPresent($contoller){
        if(file_exists(CONTROLLERS_PATH.'/'.$contoller.".php")) {
            return true;
        } else {
            return false;
        }
    }
    
    function callModules(){
    	$module = new Module();
    	
    }
    
    function setController($contoller){
    	
    	$contoller = trim(str_replace(ROOT_DIR,"",$contoller),"/");
    	
    	//check for controller name
         if($contoller==""){
           $contoller = 'index';
           $this->setUri('index');
        } 
        
        if(!$this->isControllerPresent($contoller)){
        	
        	if($this->isControllerPresent($contoller."/"."index")){
        		$contoller = $contoller."/"."index";
	            $this->setUri($contoller);
	            
        	} else {
	            $contoller = 'index';
	            $this->setUri('index');
        	}
        }
		
        
        //Modules called here
        $this->callModules();
        
        //controller file added
        include(CONTROLLERS_PATH.'/'.$contoller.".php");
        
        //get the uri part in an array
        $uri_array = $this->getUriArray();
        
        //resetting controller var
        $contoller = "";
        
        //setting the $controller class name
        foreach($uri_array as $u){
        	if($u !=  ROOT_DIR) 
        		$contoller .= "_".ucfirst($u);
        }
        
        $contoller  = trim($contoller,"_");
        
        //initialisation of the thye controller opbject
        global $contollerObj; 
        $contollerObj = new $contoller;
		
        //get the do action function name
        $doAction = $this->getDo();
		
        //call the action before the default or do action 
        $contollerObj->doBefore();

		//call the the default or do action
        if(method_exists($contollerObj,$doAction)) {
            $contollerObj->$doAction();
        }else {
            $contollerObj->doDefault();
        }
        
        //call the action after the default or do action
        $contollerObj->doAfter();
		
        global $template_view;
        
        if($template_view != "" ){
        	$contollerObj->setView($template_view['view'], $template_view['template']);
        }
        
        if($contollerObj->getView()) {
            $contollerObj->showView();
        }
    }
    
    function getDo(){
        $do = "default";
        
        if($_GET['do'])
            $do = $_GET['do'];
        
        if($_POST['do'])
            $do = $_POST['do'];

        return "do".ucfirst($do);
    }
}
?>