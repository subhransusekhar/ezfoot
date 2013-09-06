<?php 
/*
 * Module Name: mod_login
 */


class Mod_Highchart extends Sql {
	
	var $module_name = "mod_highchart";
	
	function Mod_Highchart(){
		Controller::addAction('action_head',array($this,'addToHead'));
	}
	
	function addToHead(){
		?>
		<script type="text/javascript" src="<?php echo SITE_URL.'modules/highchart/js/highcharts.js';?>"></script>
		<?php 
	}
	
}