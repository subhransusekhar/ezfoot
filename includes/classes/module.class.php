<?php
class Module {
	function Module(){
		$this->search();
	}
	function search(){
		$dir    = MODULES_PATH;
		$files = scandir($dir);
//		echo "<pre>" . print_r($files, true)."</pre>";
		foreach($files as $f):
			if(is_dir($dir."/".$f)) :
				switch($f):
					case '.':
					case '..':
						break;
					default:
						$this->embedModuleCode($f, $dir);
				endswitch;
			endif;
		endforeach;
		
	}
	
	function embedModuleCode($file_name, $dir){
		global $moduleObjs;
		if(!empty($file_name)):
			$file_path =  $dir . "/" . $file_name . "/" . $file_name . ".php";
			if(file_exists($file_path)):
				include($file_path);
				$mod_class = 'Mod_' . ucfirst($file_name);
				$mod_temp = new $mod_class;
				if(!empty($mod_temp->module_name))
					$moduleObjs[$mod_temp->module_name] = $mod_temp; /* assigns the module class obj to global varible*/   
			endif;
		endif;
	}
}