<?php

class RemoveRedundance {
	

	private $obj_closure;
	function __construct(){

		
		
	}


	function removeRedundance($arr_df){


		foreach ($arr_df as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			$arr_tmp = $arr_df;
			//Elimino el descriptor, al que le busco el cierre, del conjunto de dependencias
			unset($arr_tmp[$key]);
			//print_r($arr_tmp);
			$arr_new_dep = array_values($arr_tmp);
			//print_r($arr_new_dep);
			$arr_result = $this->$obj_closure->getClosure($arr_new_dep,$descriptor);
			// $arr_cierre = cierre($arr_new_dep,$descriptor);
			$str_cierre[] = $descriptor."|".(implode(",", $arr_cierre));

		}

		//Comparar cierres y eliminar redundancias
		foreach ($arr_result as $key => $value) {
			# code...
			list($x,$y) = explode("|", $value);
			$arr_implicated = explode(",", $y);
			list($x1,$y1) = explode("|", $arr_new_close[$key]);
			$arr_implicated1 = explode(",", $y1);

		// var_dump($arr_implicated);var_dump($arr_implicated1);

			$arr_redundance = array_diff($arr_implicated1,$arr_implicated);
			if (count($arr_redundance)==0) {
				# code...
				echo "borrar\n";
				unset($arr_new_close[$key]);
				unset($arr_no_strange[$key]);

			}
		}

		return $arr_no_strange;
	}


}