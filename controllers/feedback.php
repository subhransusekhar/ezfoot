<?php
class Feedback extends Controller{
    function Feedback(){
        parent::Controller();
    }
    function doBefore(){
        $this->site_title = "Feedback";
    }
    function doDefault(){
			/* $this->addVar("msg", "Default"); */
    }
    function doEmail(){
        $to      = 'user@example.com';
        $name	 = $_POST['name'];
        $email	 = $_POST['email'];;
        $subject = 'Zurl.in: '.$_POST['subject']. " FROM ".$name ;
        $message = $_POST['message'] ;
        if( $name ==""){
                $msg = "Please enter your name.";
        }
        else if( $email ==""){
                $msg = "Please enter your email address.";
        }
        else if( $subject ==""){
                $msg = "Please enter subject.";
        }
        else if( $subject ==""){
                $msg = "Please enter your message.";
        }
        else{
                $headers = 'From: '.$email . "\r\n" .
                                   'Reply-To: '.$email . "\r\n" .
                                   'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);								                unset($_POST);                
                $msg = "Thank you for your message";
        }
        if($msg){
                //$msg .=" <a href='".SITE_URL_LINK."feedback'>Back</a>";
        }
        $this->addVar("msg", $msg);
    }		        
    function doAfter(){
        $this->setView("feedback",true);
    }
    function doPrint(){
        $this->addVar("msg", "Print function");
    }
}