<?php




class RemoveStrange{

	private $obj_closure;

	function __construct($obj_closure){

		$this->obj_closure=$obj_closure;
		
	}



function removeStange($arr_df,$atribute,$y){

	$i=0;
	$done=false;
	$arr_cierre = array();
	$arr_atribute = explode(",", $atribute);
	$arr_implicated = explode(",", $y);
	$limit = count($arr_atribute);
	$arr_final = $arr_atribute;
	$arr_implicated = explode(",", $y);

	while ($done===false and count($arr_final)>1) {
		# code...

		//list($x,$y) = explode("|", $arr_df);


		$arr_work = $arr_final;
		unset($arr_work[$i]);
		$arr_new = array_values($arr_work);
		$new_atribute = implode(",", $arr_new);
		// echo "entro $new_atribute \n";
		$arr_cierre = $this->obj_closure->getClosure($arr_df,$new_atribute);
		$bol_strange = in_array($arr_final[$i], $arr_cierre);
		// $bol_strange_2 = in_array($y, $arr_cierre);
		$check = array_diff($arr_implicated, $arr_cierre);
		// if ($atribute=='C,E') {
		// 	# code...
		// 	echo "cierre";
		// 	var_dump($arr_cierre);
		// }
		// print_r($check);

		$arr_cierres[]=$arr_cierre;
		if ($bol_strange or (is_array($check) and count($check)==0 )) {
			# code...
			//eliminar ese elemento
			// echo "elimina\n";
			unset($arr_final[$i]);
			$arr_final = array_values($arr_final);
			$i=0;

		}else{
			$i++;
		}
		if ($i == count($arr_final)) {
			# code...
			$done=true;
		}
		
	}
	// var_dump($arr_final);
	return array_values($arr_final);
}
	
}
