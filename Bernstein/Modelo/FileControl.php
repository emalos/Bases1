
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
			$this->path = '/Users/edwinmalo/NetBeansProjects/Bases1/Bernstein/';
		}else{
			$this->path = $path;	
		}
		
	}
	 

	function checkFile(){

		$nombre_archivo = date('YmdHis').'.xml';
		// $rutaArchivoServidor = '../test/'.$nombre_archivo;
		$tipo_archivo = $_FILES['userfile']['type'];
		$tamano_archivo = $_FILES['userfile']['size'];

		//compruebo si las características del archivo son las que deseo
		if (!(strpos($tipo_archivo, "xml"))) {
		    $rpta = "La extensi&oacute;n o el tama&ntilde;o de los archivos no es correcta. 
		    <br><br><table><tr><td><li>Se permiten archivos .xml<br>
		    <li>se permiten archivos de 100 Kb m&aacute;ximo.</td></tr></table>";
		}else{
		    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $this->path.$nombre_archivo)){
				$rpta = "Archivo cargado satisfactoriamente";
				// require '../Modelo/algoritmo2.php';
				// die;
		    }else{
		       $rpta = "Ocurri&oacute; alg&uacute;n error al subir el fichero. No pudo guardarse.";
		    }
		}

		return $rpta;
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


