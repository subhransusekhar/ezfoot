<?php
class Register extends Controller{
    function Login(){
        //needed to excecute the parent contructor
        parent::Controller();
    }
    
    function doBefore(){
        $this->site_title = "Register";
    }

    function doDefault(){
        
    }

    function doAfter(){
        $this->setView("register",true);        $this->setView("comingsoon", true);
    }
    
    function doRegister(){
        $msg = "No action written for register!";
			$this->addVar("msg", $msg);
    }
}