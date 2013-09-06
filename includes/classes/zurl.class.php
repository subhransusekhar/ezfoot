<?php
class Zurl {
	private $table = "url";
	function generateUrl($url){
		if($result = $this->searchURL($url)){
			return $result['generated_url'];
		}
		$code = $this->codeGenerator();
		$sqlObject = new Sql();
		$data = array(	"original_url" => "'".$url."'",
						"generated_url" => "'".$code."'",
						"date" => "NOW()");
		
		$query = $sqlObject->createInsertQuery($this->table,$data);
		
		$sqlObject->executeQuery($query);
		return $code;
	}
	function searchURL($url){
		$sqlObject = new Sql();
		$query = "SELECT * FROM " . $this->table . " where original_url = '" . $url . "'";
		return $sqlObject->executeQuery($query,2);
	}
	
	function searchCode($code){
		$sqlObject = new Sql();
		$query = "SELECT * FROM " . $this->table . " where generated_url = '" . $code . "'";
		return $sqlObject->executeQuery($query,2);
	}
	
	function getCountCodeOfLength($length){
		$sqlObject = new Sql();
		$query = "SELECT COUNT(*) cnt FROM " . $this->table . " WHERE LENGTH(generated_url)= ".$length;
		$result = $sqlObject->executeQuery($query,2);
		return $result['cnt'];
	}
	
	
	
	function getNoOfCode($digit){
		$n = 36;
		$noOfCode = 0;
		for($i=0;$i<=$digit;$i++){
			$noOfCode += pow($n, $i);
		}
		return $noOfCode;
	}
	
	function setConter(){
		$result = $this->getConterMax();
		$max = $this->getNoOfCode($result['digit']);
		if($this->getCountCodeOfLength($result['digit'])>=$max) {
			$sqlObject = new Sql();
			$data = array( 	"is_finished" 	=> 	1);
			$condition = array(	"digit"	=>	$result['digit']);
			$result = $sqlObject->createUpdateQuery("counter",$data,$condition);
		}
	}
	function getConterMax(){
		$sqlObject = new Sql();
		$query = "SELECT * FROM counter WHERE digit=(SELECT MAX(digit) FROM counter)";
		return $sqlObject->executeQuery($query,2);
	}
	
	function getLength(){
		$this->setConter();
		$result = $this->getConterMax();
		if($result['is_finished'] == 1){
			
			$sqlObject = new Sql();
			$data = array(	"digit" => $result['digit']+1,
							"is_finished" => 0);
			$query = $sqlObject->createInsertQuery("counter",$data);
			$sqlObject->executeQuery($query);
			return ($result['digit']+1);
		}else {
			return $result['digit'];
		}
	}
	
	function codeGenerator() {
		$code = "";
		$length = $this->getLength();
		
		for($i=1;$i<=$length;$i++) {
			$code.= $this->assign_rand_value(rand(1,36));
		}
		
		if($this->searchCode($code)){
			$this->codeGenerator();
		}
		return $code;
	}
	function assign_rand_value($num)
	{
	// accepts 1 - 36
	  switch($num)
	  {
	    case "1":
	     $rand_value = "a";
	    break;
	    case "2":
	     $rand_value = "b";
	    break;
	    case "3":
	     $rand_value = "c";
	    break;
	    case "4":
	     $rand_value = "d";
	    break;
	    case "5":
	     $rand_value = "e";
	    break;
	    case "6":
	     $rand_value = "f";
	    break;
	    case "7":
	     $rand_value = "g";
	    break;
	    case "8":
	     $rand_value = "h";
	    break;
	    case "9":
	     $rand_value = "i";
	    break;
	    case "10":
	     $rand_value = "j";
	    break;
	    case "11":
	     $rand_value = "k";
	    break;
	    case "12":
	     $rand_value = "l";
	    break;
	    case "13":
	     $rand_value = "m";
	    break;
	    case "14":
	     $rand_value = "n";
	    break;
	    case "15":
	     $rand_value = "o";
	    break;
	    case "16":
	     $rand_value = "p";
	    break;
	    case "17":
	     $rand_value = "q";
	    break;
	    case "18":
	     $rand_value = "r";
	    break;
	    case "19":
	     $rand_value = "s";
	    break;
	    case "20":
	     $rand_value = "t";
	    break;
	    case "21":
	     $rand_value = "u";
	    break;
	    case "22":
	     $rand_value = "v";
	    break;
	    case "23":
	     $rand_value = "w";
	    break;
	    case "24":
	     $rand_value = "x";
	    break;
	    case "25":
	     $rand_value = "y";
	    break;
	    case "26":
	     $rand_value = "z";
	    break;
	    case "27":
	     $rand_value = "0";
	    break;
	    case "28":
	     $rand_value = "1";
	    break;
	    case "29":
	     $rand_value = "2";
	    break;
	    case "30":
	     $rand_value = "3";
	    break;
	    case "31":
	     $rand_value = "4";
	    break;
	    case "32":
	     $rand_value = "5";
	    break;
	    case "33":
	     $rand_value = "6";
	    break;
	    case "34":
	     $rand_value = "7";
	    break;
	    case "35":
	     $rand_value = "8";
	    break;
	    case "36":
	     $rand_value = "9";
	    break;
	  }
	return $rand_value;
	}		function getTotalUrlCount(){		$sqlObject = new Sql();		$cnt_query = "SELECT count(*) cnt FROM " . $this->table . " " . $order_by;				$row_count = $sqlObject->executeQuery($cnt_query,2);				return $row_count['cnt'];	}		function getTotalTodayUrlCount(){		$sqlObject = new Sql();		$cnt_query = "SELECT count(*) cnt FROM " . $this->table . " ".		'WHERE DATE_FORMAT(date,\'%Y-%m-%d\') = \''.date('Y-m-d').'\' ';;			$row_count = $sqlObject->executeQuery($cnt_query,2);			return $row_count['cnt'];	}		function getAllURL($page = 1, $items = null){			$sqlObject = new Sql();				if($items == null)			$items = ITEM_PER_PAGE;				$start = ($page - 1) *  $items;				$order_by = "ORDER BY id DESC ";				$limit = "LIMIT $start, $items";				$query = "SELECT * FROM " . $this->table . " " . $order_by. $limit;				$result = $sqlObject->executeQuery($query,1);				$data = array();				while($row = mysql_fetch_array($result)){			$data[] = $row;		}				$cnt_query = "SELECT * FROM " . $this->table . " " . $order_by;				$row_count = $sqlObject->executeQuery($cnt_query,4);				$page_count = $row_count / $items;				return array('data' => $data, 'page_count' => $page_count);	}
}
?>