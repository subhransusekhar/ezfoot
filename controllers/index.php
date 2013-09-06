<?php
class Index extends Controller{
    function Index(){
        //needed to excecute the parent contructor
        parent::Controller();
    }
    
    function doBefore(){
        $this->site_title = "Home";        $this->setView("index",true);
    }

    function doDefault(){
        $uri = $this->getUri();				        
        if(!$this->isControllerPresent($uri) && $uri!=""){
            $zurlObj = new Zurl(); 
            $result = $zurlObj->searchCode($uri);
            if($result) {
                $temp = substr($result['original_url'],0,7);
                $http = ($temp!='http://')?"http://":"";								global $moduleObjs;								                if(!empty($moduleObjs['mod_tracker'])){                	$client_ip = $_SERVER['REMOTE_ADDR'];                	$moduleObjs['mod_tracker']->recodeIP($client_ip ,$result['id']);                }                
                header("Location: ".$http.$result['original_url']);
               	$this->setView("analytic",true);
            }else {
                $msg = "Sorry. No link found!!!";
            }
            $this->addVar("msg", $msg);
		}
    }

    function doAfter(){
        
    }
    
    function doGenerate(){
        $zurlObj = new Zurl();
        $url = $_REQUEST['url'];
        if(trim($url)!="" && $url != "insert your url"){						$genUrl = SITE_URL_LINK.$zurlObj->generateUrl($url);
            /*$msg =  "Generated URL: <strong>" . $genUrl . '</strong>';*/            $msg = '<div id="gen_url_content"><div class="field-row">';						$msg .= '<div class="field-name"><label>Generated URL:</label></div>';            $msg .= '<div class="field-input"><input type="rexr" readonly="readonly" id="generated_url" value="'.$genUrl.'" /></div>';            $msg .= '<div class="field-input"><a style="font-size: 18px;" id="copy_to_clip" class="submit-btn">Copy to Clipboard</a></div>';            $msg .= '<div class="clear"></div></div>';            $msg .= '</div>';            
        } else {						
            $msg = '<div id="gen_url_content" class="apply-cufon">Please Enter a url.</div>';						
        }
        $this->addVar("msg", $msg);
    }
}