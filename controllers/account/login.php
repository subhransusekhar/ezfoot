<?php
class Account_Login extends Controller{
    function Account_Login(){
        //needed to excecute the parent contructor
        parent::Controller();
    }
    
    function doBefore(){
        $this->site_title = "Login";
    }

    function doDefault(){
        
    }

    function doAfter(){
        $this->setView("account/login",true);
    }
}