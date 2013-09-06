<?php
class Account_Account extends Controller{
    function Account_Account(){
        //needed to excecute the parent contructor
        parent::Controller();
    }
    
    function doBefore(){
        $this->site_title = "My Account";
    }

    function doDefault(){
        
    }	
    function doAfter(){	    global $moduleObjs;		$user = $moduleObjs['mod_login']->getCurrentUser();		if($user){			foreach($user as $index=>$value){				$this->addVar($index, $value);			}		}
        $this->setView("account/account",true);
    }
}