<?php

require_once 'ReduceRedundancy.php';
require_once 'RemoveStrange.php';
require_once 'ClosureAlgorithm.php';

class BernsteinAlgorithm{

	private $obj_closure;
	private $obj_del_strange;
	private $obj_del_redundant;
	private $obj_file;

	function __construct($obj_file=null){

		$this->obj_file = $obj_file;
		
	}

	function getSythesis($arr_test){
	
	$this->obj_closure = new ClosureAlgorithm();
	$this->obj_del_strange = new RemoveStrange($this->obj_closure);
	$this->obj_del_redundant = new ReduceRedundancy($this->obj_closure);
		
		//Cierre de F
		//No se usa por ahora
// 		$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		foreach ($arr_test as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			//$arr_cierre = cierre($arr_test,$descriptor);
			$arr_cierre = $this->obj_closure->getClosure($arr_test,$descriptor);
			$new_implicated = implode(",", $arr_cierre);
// 			echo "$descriptor|$new_implicated\n";

		}

		//Lado derecho simple
		foreach ($arr_test as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			//$arr_cierre = cierre($arr_test,$descriptor);
			$arr_implicated = explode(",", $implicated);
			foreach ($arr_implicated as $key => $value) {
				# code...
				$arr_simple_df[] = "$descriptor|$value";
			}
// 			echo "$descriptor|$new_implicated\n";

		}
var_dump($arr_simple_df);





		//Eliminar Extraños

// 		echo"Sin elemento extraño: \n";
		// $arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		foreach ($arr_simple_df as $key => $value) {
			# code...
			list($x,$y) = explode("|", $value); 
			// $arr_del = delIzq($arr_test,$x);
			$arr_del = $this->obj_del_strange->removeStange($arr_simple_df,$x,$y);
			//print_r($arr_del);
			$algo = implode(",", $arr_del);
			$arr_no_strange[] = "$algo|".$y;
		}
		
		$arr_no_strange_final = array();
		foreach ($arr_no_strange as $key => $value) {
			# code...
			if (!in_array($value, $arr_no_strange_final)) {
				# code...
				$arr_no_strange_final[]=$value;
			}
		}

 		var_dump($arr_no_strange_final);


		//Eliminar redundancias
// 		echo "Redundancias\n";

		// $arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
		//$arr_df = explode("|", $arr_test);
		// $arr_result = delRedundant($arr_no_strange);
		$arr_result = $this->obj_del_redundant->removeRedundancy($arr_no_strange_final);
// 		print_r($arr_result);

		//DF simplificado
// 		echo "Sin redundancias\n";
		$new_df = array_values($arr_result);
// 		$new_df_closure = (array_values($arr_new_close));
		var_dump($new_df);

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
// 		echo "Agrupado\n";
// 		print_r($arr_union);

		foreach ($arr_union as $key => $value) {
			# code...
			list($descriptor,$implicated) = explode("|", $value);
			$arr_cierre = $this->obj_closure->getClosure($arr_union,$descriptor);
			$new_implicated = implode(",", $arr_cierre);
			$arr_tes[] =  "$descriptor|$new_implicated";


		}
// 		echo "Cierre Agrupado\n";
// 		print_r($arr_tes);

		return $arr_union;


	}


}

