<?php

require_once 'Improvement.php';

class SuperfluousElement {

	private $obj_closure;
	  
	function __construct($obj_closure){

		$this->obj_closure=$obj_closure;
		
	}
	

	function getSuperfluous($arr_attributes,$relation_keys,$attribute,$arr_grouped,$key_of_relation,$key_att){

//echo "NUEVO ATRIBUTO $attribute \n ";

		$arr_keys = Improvement::getAttributes($relation_keys);

		$arr_difference = array_diff($arr_attributes, $arr_keys);


		if (is_array($arr_difference)) {
			# code...
			//No contiene la llave todos los atributos de Ri
			$bol_superfluo=true;
			//echo "no contiene todos los atributos\n";


		}else{
			//El atributo no es superfluo
			return false;
		}

		$arr_key_i=array();

		foreach ($relation_keys as $key => $value) {
			# code...
			//busco las llaves que tienen el atributo no deseado y no las tengo en cuenta
			$bol_attr = strpos($value, $attribute);
			if ($bol_attr===false) {
				# code...
				//echo "$value sin el atributo $attribute\n";
				$arr_key_i[] = $value;
			}else{
				$arr_removed_keys[]=$value;
				//echo "$value con el atributo $attribute\n";
			}
		}
		//var_dump($arr_key_i);

		$arr_att_tmp = $arr_attributes;
		unset($arr_att_tmp[$key_att]);
		//echo "array atributos sin B\n";
		//var_dump($arr_att_tmp);

		//Ki no esta vacio
		if (count($arr_key_i)>0) {
			# code...
			foreach ($arr_key_i as $key => $value) {
				# code...
				$arr_attr_key = explode(",", $value);
				//se crea un Gi con las ki y los atributos faltantes del conjunto
				$str_tmp = implode(",", array_diff($arr_att_tmp, $arr_attr_key));
				if ($str_tmp!='') {
					# code...
					$arr_Gi[]= $value."|".$str_tmp;
				}
				
			}
			//recorremos las otras Ri ($key_of_relation!=$key) y agregamos las relaciones al Gi
			foreach ($arr_grouped as $key => $value_relation) {
				# code...
				if ($key_of_relation!=$key) {
					# code...
					foreach ($value_relation as $value) {
						# code...
						$arr_Gi[]=$value;
					}
					
				}
			}
			//echo"Gi :\n";
			//var_dump($arr_Gi);

			//Check Restorability
			foreach ($arr_key_i as $key => $value) {
				# code...
				$closure = $this->obj_closure->getClosure($arr_Gi,$value);
				if (!in_array($attribute, $closure)) {
					# code...
					//echo "no pertenece\n";
					$bol_superfluo=false;
					return false;
				}else{
					//echo"si pertenece\n";
					$bol_superfluo=true;
				}
				//var_dump($closure);
			}
		

		//Check nonessentiality
		$arr_tmp = array_diff($relation_keys, $arr_key_i);

		//echo"Ki-Ki'\n";
		//var_dump($arr_tmp);

		foreach ($arr_tmp as $key => $value) {
			# code...
			$closure = $this->obj_closure->getClosure($arr_Gi,$value);
			//echo "cierre\n";
			//var_dump($closure);
			// $arr_tmp = array_diff($closure, $arr_attributes);
			$arr_tmp = array_diff($arr_attributes,$closure);
			if (count($arr_tmp)>0) {
				# code...
				//No pertenece a cierre
				//interseccion entre el cierre y los atributos
				$arr_intersection = array_intersect($closure, $arr_attributes);

				$possition = array_search($attribute, $arr_intersection);
				if ($possition!==false) {
					# code...
					unset($arr_intersection[$possition]);
				}
				$str_intersec = implode(",", $arr_intersection);
				$closure_intersec = $this->obj_closure->getClosure($arr_Gi,$str_intersec);
				$arr_tmp_intersec = array_diff($closure_intersec, $arr_attributes);
				if (count($arr_tmp_intersec)>0) {
					return false;

				}else{
					//echo"insertar algo";
					// $arr_key_i[]=$arr_removed_keys;

					//insertar algo!!
					//insert into K,’ any key of Ri contained in (M II Ai) - B
				}
				
			}else{
				//echo"si pertenece al cierre\n";
			}

		}
	}else{
		//echo "Ki es VACIO\n";
		$bol_superfluo = false;
	}

if ($bol_superfluo) {
	# code...
	//echo"es superfluo\n";
	//var_dump($arr_key_i);
	return $arr_key_i;
}else{
	//echo"no lo es!!\n";
	return false;
}



	}


}