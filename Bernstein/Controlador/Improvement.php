<?php

require_once 'ReduceRedundancy.php';
require_once 'RemoveStrange.php';
require_once 'ClosureAlgorithm.php';
require_once 'SuperfluousElement.php';

class Improvement{

	private $obj_closure;
	private $obj_del_strange;
	private $obj_del_redundant;
	private $obj_file;
	private $obj_del_superfluous;

	function __construct($obj_file=null){

		$this->obj_file = $obj_file;
		
	}

//getImprovedTNF
	function getSythesis($arr_test){

		$this->obj_closure = new ClosureAlgorithm();
		$this->obj_del_strange = new RemoveStrange($this->obj_closure);
		$this->obj_del_redundant = new ReduceRedundancy($this->obj_closure);
		$this->obj_del_superfluous = new SuperfluousElement($this->obj_closure);

		//Lado derecho simple
		// foreach ($arr_test as $key => $value) {
		// 	# code...
		// 	list($descriptor,$implicated) = explode("|", $value);
		// 	//$arr_cierre = cierre($arr_test,$descriptor);
		// 	$arr_implicated = explode(",", $implicated);
		// 	foreach ($arr_implicated as $key => $value) {
		// 		# code...
		// 		$arr_simple_df[] = "$descriptor|$value";
		// 	}
		// }
		//var_dump($arr_test);
		$arr_simple_df = $arr_test;
		
		//Eliminar Extraños

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

 		// //var_dump($arr_no_strange_final);


 		//remover redundantes

 		$arr_result = $this->obj_del_redundant->removeRedundancy($arr_no_strange_final);

		$arr_no_redundant = array_values($arr_result);

		// //var_dump($arr_no_redundant);
 		//redundantes

 		//Agrupar en clases segun v1->v2 e F+

 		//sacar lados iz y der
		foreach($arr_no_redundant as $key => $value){
		  list($x,$y) = explode("|", $value);
		  $arr_left_side[] =$x;  
		  $arr_right_side[] =$y;
		  
		}

		//hallamos el cierre de todos los determinantes
		foreach ($arr_left_side as $key => $value) {
			# code...
			$arr_closure[]=$this->obj_closure->getClosure($arr_no_redundant,$value);

		}
		foreach ($arr_left_side as $key_left => $x) {
			# code...
			// $arr_relation[]=$x."|".$arr_right_side[$key_left];
			$arr_relations = null;
			foreach ($arr_left_side as $key_left_2 => $value) {
				# code...
				$arr_x = explode(",", $x);
				$arr_val = explode(",", $value);

				$arr_tmp_x=array_diff($arr_val, $arr_closure[$key_left]);
				$arr_tmp_y=array_diff($arr_x, $arr_closure[$key_left_2]);
				if (count($arr_tmp_x)==0 and count($arr_tmp_y)==0) {
					# code...
					//los lados izq son equivalentes
					$arr_relations[]=$arr_left_side[$key_left_2]."|".$arr_right_side[$key_left_2];
					unset($arr_left_side[$key_left_2]);
				}
			}
			// unset($arr_left_side[$key_left]);
			if ($arr_relations) {
				# code...
				$arr_grouped[] = $arr_relations;
			}
			
		}		var_dump($arr_grouped);

		foreach ($arr_grouped as  $to_group) {
			# code...
			$arr_tmp_group[] = $this->groupDFs($to_group);

		}
		var_dump($arr_tmp_group);

 
 		//Algoritmo de eliminacion de normalizacion
		//Recorremos cada relacion obtenida del algoritmo preparatorio
		foreach ($arr_tmp_group as $key => $arr_relation) {
			# code...
			$arr_attributes = $this->getAttributes($arr_relation);
			$arr_keys = $this->getKeys($arr_relation);
			// //var_dump($arr_attributes);
			// //var_dump($arr_keys);
			foreach ($arr_attributes as $key_att => $attribute) {
				# code...
				//Se revisa que no sea superfluo
				$response = $this->obj_del_superfluous->getSuperfluous($arr_attributes,$arr_keys,$attribute,$arr_tmp_group,$key,$key_att);
				if (is_array($response) and count($response)>0) {
					# code...
					//Se elimina $attribute del $arr_attributes
					unset($arr_attributes[$key_att]);
					$arr_attributes = array_values($arr_attributes);
					$arr_keys = $response;

				}

			}

			$arr_final[]=array($arr_attributes,$arr_keys);
		}

		var_dump($arr_final);
		return $arr_final;

	}

	static function getAttributes($arr_relation){

		$arr_join=array();
		foreach ($arr_relation as $key => $value) {
			# code...
			$tmp = str_replace("|", ",", $value);
			$arr_tmp = explode(",", $tmp);
			$arr_join = array_merge($arr_join,$arr_tmp);
		}
		return array_values(array_unique($arr_join));


	}
	function getKeys($arr_relation){

		$arr_join=array();
		foreach ($arr_relation as $key => $value) {
			# code...
			$arr_tmp = explode("|", $value);
			$arr_keys[] = $arr_tmp[0];
		}
		return $arr_keys;


	}

	function groupDFs($new_df){

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
		return $arr_union;
	}


}