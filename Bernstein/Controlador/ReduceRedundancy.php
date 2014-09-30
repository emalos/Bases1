<?php

class ReduceRedundancy {
	

	private $obj_closure;
	  
	function __construct($obj_closure){

		$this->obj_closure=$obj_closure;
		
	}


	function removeRedundancy($arr_df){


		//Cierre de F
// 		$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		foreach ($arr_df as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			$arr_cierre = $this->obj_closure->getClosure($arr_df,$descriptor);
			$new_implicated = implode(",", $arr_cierre);
			$arr_new_close[] =  "$descriptor|$new_implicated";


		}
// 		echo "Cierre\n";
// 		print_r($arr_new_close);
		
		foreach ($arr_df as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			$arr_tmp = $arr_df;
			//Elimino el descriptor, al que le busco el cierre, del conjunto de dependencias
			unset($arr_tmp[$key]);
			//print_r($arr_tmp);
			$arr_new_dep = array_values($arr_tmp);
			//print_r($arr_new_dep);
			$arr_result = $this->obj_closure->getClosure($arr_new_dep,$descriptor);
			// $arr_cierre = cierre($arr_new_dep,$descriptor);
			$str_cierre[] = $descriptor."|".(implode(",", $arr_result));

		}
// 		print_r($str_cierre);

		//Comparar cierres y eliminar redundancias
		foreach ($str_cierre as $key => $value) {
			# code...
			list($x,$y) = explode("|", $value);
			$arr_implicated = explode(",", $y);
			list($x1,$y1) = explode("|", $arr_new_close[$key]);
			$arr_implicated1 = explode(",", $y1);

		// var_dump($arr_implicated);var_dump($arr_implicated1);

			$arr_redundance = array_diff($arr_implicated1,$arr_implicated);
			if (count($arr_redundance)==0) {
				# code...
// 				echo "borrar\n";
// 				unset($arr_new_close[$key]);
				unset($arr_df[$key]);

			}
		}

		return $arr_df;
	}


}