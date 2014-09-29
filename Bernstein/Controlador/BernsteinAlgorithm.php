<?php

require_once 'ReduceRedundance.php';
require_once 'RemoveStrange.php';
require_once 'Closure.php';

class BernsteinAlgorithm{

	private $obj_closure;
	private $obj_del_strange;
	private $obj_del_redundatn;
	private $obj_bernstein;

	function __construct($obj_file){

		$this->obj_file = $obj_file;
		
	}

	function getSythesis($arr_test){
		
		//Cierre de F
		//No se usa por ahora
		$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		foreach ($arr_test as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			//$arr_cierre = cierre($arr_test,$descriptor);
			$this->obj_closure->getClosure($arr_df,$atribute);
			$new_implicated = implode(",", $arr_cierre);
			echo "$descriptor|$new_implicated\n";

		}

		//Eliminar Extraños

		echo"Sin elemento extraño: \n";
		// $arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		foreach ($arr_test as $key => $value) {
			# code...
			list($x,$y) = explode("|", $value); 
			// $arr_del = delIzq($arr_test,$x);
			$this->obj_del_strange($arr_test,$x);
			//print_r($arr_del);
			$algo = implode(",", $arr_del);
			$arr_no_strange[] = "$algo|".$y;
		}

		print_r($arr_no_strange);


		//Eliminar redundancias
		echo "Redundancias\n";

		$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		//$arr_df = explode("|", $arr_test);
		// $arr_result = delRedundant($arr_no_strange);
		$this->obj_del_redundant->removeRedundant($arr_no_strange);
		print_r($arr_result);

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
		//DF simplificado
		echo "Sin redundancias\n";
		$new_df = array_values($arr_no_strange);
		$new_df_closure = (array_values($arr_new_close));
		print_r($new_df);




		//DF simplificado
		echo "Sin redundancias\n";
		$new_df = array_values($arr_no_strange);
		$new_df_closure = (array_values($arr_new_close));
		print_r($new_df);

		//sacar lados iz y der
		foreach($new_df as $key => $value){
		  list($x,$y) = explode("|", $value);
		  $arr_left_side[] =$x;  
		  $arr_right_side[] =$y;
		  
		}



		//agrupar lados iz identicos
		foreach($new_df as $key => $value){
		  list($x,$y) = explode("|", $value);
		//   $key_df = array_search($value, $new_df);
		  
		  $keys_df = array_keys($arr_left_side,$x);
		//   print_r($keys_df);
		  
		  if(is_array($keys_df) and count($keys_df)>0){
		    foreach($keys_df as $keydf){
		     $arr_tmp[] = $arr_right_side[$keydf];
		     unset($arr_left_side[$keydf]);
		    }
		    
		    $arr_union[] = $x."|".implode(",",$arr_tmp);//$arr_tmp;
		    $arr_tmp = array();
		  }
		  
		}
		echo "Agrupado\n";
		print_r($arr_union);

		foreach ($arr_union as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			$arr_cierre = cierre($arr_union,$descriptor);
			$new_implicated = implode(",", $arr_cierre);
			$arr_tes[] =  "$descriptor|$new_implicated";


		}
		echo "Cierre Agrupado\n";
		print_r($arr_tes);




	}


}

