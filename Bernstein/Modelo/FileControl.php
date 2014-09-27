
<?php


class FileControl {

/*
*
* $arr_df formato A,B,C|D,F donde ABC->DF
**/
	public $path;
	public $xml;

	function __construct($path){

		if ($path =='') {
			# code...
			$this->path = '/Users/edwinmalo/NetBeansProjects/Bases1/Bernstein/test.xml';
		}else{
			$this->path = $path;	
		}
		
	}
	 

	function loadFile(){

		if (file_exists()) {
	    	$this->xml = simplexml_load_file($path);
	 
	    //print_r($xml);
		} else {
			$this->xml = null;
		    exit('Failed to open test.xml.');
		}

	} 
	
	function processXml($xml){
		
		foreach ($xml->children() as $child) {
			# code...
			foreach ($child ->children() as $value) {
				# code...
				$arr_tmp[$child->getname()][] = (string)$value[0];
			}
		}
	return($arr_tmp);

	}


	



}


