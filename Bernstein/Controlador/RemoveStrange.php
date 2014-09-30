<?php




class RemoveStrange{

	private $obj_closure;

	function __construct($obj_closure){

		$this->obj_closure=$obj_closure;
		
	}



function removeStange($arr_df,$atribute){

	$i=0;
	$done=false;
	$arr_atribute = explode(",", $atribute);
	$limit = count($arr_atribute);
	$arr_final = $arr_atribute;
	while ($done===false) {
		# code...
		$arr_work = $arr_final;
		unset($arr_work[$i]);
		$arr_new = array_values($arr_work);
		$new_atribute = implode(",", $arr_new);
		$arr_cierre = $this->obj_closure->getClosure($arr_df,$new_atribute);
		$bol_strange = in_array($arr_final[$i], $arr_cierre);
		$arr_cierres[]=$arr_cierre;
		if ($bol_strange) {
			# code...
			//eliminar ese elemento
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
	return array_values($arr_final);
}
	
}
