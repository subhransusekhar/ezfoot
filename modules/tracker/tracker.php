<?php 
/*
 * Module Name: mod_tracker
 */


class Mod_Tracker extends Sql {
	
	var $module_name = "mod_tracker";
	
	var $table_name = "mod_tracker";
	
	function Mod_Tracker(){
		$this->install();
	}
	
	function install() {
		$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->table_name.'` (
				`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`reffer_id` 	INT( 11 ) NOT NULL ,
				`ip`			VARCHAR( 255 ) NOT NULL,
				`date` 			DATETIME	NULL 
				)';
	
		$this->executeQuery($sql);
	}
	
	function recodeIP($ip, $reffer_id){
		
		$arg = array( 	'ip' 		=> "'$ip'",
						'reffer_id' =>  $reffer_id,
						'date'		=> "'".date('Y-m-d H:i:s')."'"
					);
		
		$sql = $this->createInsertQuery($this->table_name,$arg);
		$ip_id = $this->executeQuery($sql,5);
		return $ip_id;
	}
	
	function hitCount($reffer_id){
		$sql = 'SELECT count(*) cnt FROM `'.$this->table_name.'` WHERE reffer_id = '.$reffer_id;
		$row = $this->executeQuery($sql,2);
		
		return $row['cnt'];
	}
	
	function totalHitCount(){
		$sql = 'SELECT count(*) cnt FROM `'.$this->table_name.'` ';
		$row = $this->executeQuery($sql,2);
		return $row['cnt'];
	}
	
	function totalTodayHitCount(){
		$sql = 'SELECT count(*) cnt FROM `'.$this->table_name.'` WHERE '.
		'DATE_FORMAT(date,\'%Y-%m-%d\') = \''.date('Y-m-d').'\' ';
		$row = $this->executeQuery($sql,2);
		return $row['cnt'];
	}
	
	function getGetDailyHits(){
		$hr = array(
						'00', '01', '02', '03', '04', '05', '06',
						'07', '08', '09', '10', '11', '12', '13',
						'14', '15', '16', '17', '18', '19', '20',
						'21', '22', '23'
					);
		
		$data = array();
		foreach($hr as $h){
			$sql = ' SELECT count(*) cnt FROM `'.$this->table_name.'` WHERE '.
					'DATE_FORMAT(date,\'%Y-%m-%d %H\') = \''.date('Y-m-d '.$h).'\'';
			
			$row = $this->executeQuery($sql,2);
			$data[] = $row['cnt'];
		}
		return $data;
	}
	function getdailyhits($limit = 10){
		$sql = 'SELECT T.*, U.generated_url, U.original_url FROM `'.$this->table_name.'` T 
		      	JOIN url U ON U.id = T.reffer_id '.
		'ORDER BY T.date DESC LIMIT 0,'.$limit;
		$result = $this->executeQuery($sql,1);
		
		$data = array();
		while($row = mysql_fetch_array($result)){
			$data[] = $row; 
		}
		return $data;
	}
}