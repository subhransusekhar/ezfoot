<?php

class Account_Urllist extends Controller{

    function Account_Urllist(){

        //needed to excecute the parent contructor

        parent::Controller();

    }

    

    function doBefore(){

        $this->site_title = "Url List";

    }
	
    function doDefault(){
	
    }
	
    function doAfter(){
    	$zurlObj = new Zurl();
    	
    	$paged = 1;
    	
    	if(!empty($_REQUEST['page']))
    		$paged = $_REQUEST['page'];
    	
    	$urllist = $zurlObj->getAllURL($paged);
    	
    	$this->addVar("data", $urllist['data']);
    	$this->addVar("page_count", $urllist['page_count']);
    	
        $this->setView("account/urllist",true);

    }


}
