<?php
class Uri{
    private $uri;
    private $uriArray;
    public function Uri(){
        $request_uri= explode('?',$_SERVER['REQUEST_URI']);
        $request_uri = trim(str_replace("index.php","",$request_uri[0]),"/");
        if(ROOT_DIR) {
        	$request_uri = trim(str_replace(ROOT_DIR,"",$request_uri),"/");
        }
        $uri_array = preg_split('/\//', $request_uri);
        $this->uri = $request_uri;
        $this->uriArray = $uri_array;
    }
    public function getRequestUri(){
    	return $_SERVER['REQUEST_URI'];
    }
    public function getUri(){
        return $this->uri;
    }
    public function getUriArray(){
        return $this->uriArray;
    }
    public function setUri($var){
    	$request_uri = trim(str_replace("index.php","",$var),"/");
    	
        $uri_array = preg_split('/\//', $request_uri);
        $this->uri = $request_uri;
        $this->uriArray = $uri_array;

    }
}