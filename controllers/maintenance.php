<?php

class Maintenance extends Controller{

    function Maintenance(){

        //needed to excecute the parent contructor

        parent::Controller();

    }

    

    function doBefore(){

        $this->site_title = "Maintenance";

    }



    function doDefault(){

        

    }



    function doAfter(){

        $this->setView("maintenance",true);

    }
    

}