
<?php

class Closure{

	function getClosure($arr_df,$atribute){

		$i=0;
		$done=false;
		//$atribute = str_replace(",", "", $atribute);
		//separo en un array el descriptor
		$arr_atribute = explode(",", $atribute);
		//inicializo el cierre
		$arr_closure = $arr_atribute;
		//echo "$closure ";
		while ($done===false) {
			# code...
			$arr_dependency = explode("|", $arr_df[$i]);
			//implicante
			//$arr_descriptor = str_replace(",", "", $arr_dependency[0]); //$arr_dependency[0];//
			$arr_descriptor = explode(",", $arr_dependency[0]);
			//implicado
			//$arr_implicated = str_replace(",", "", $arr_dependency[1]); //$arr_dependency[1];//
			$arr_implicated = explode(",", $arr_dependency[1]);

			//Comparamos el descriptor con el cierre
			$diff = array_diff($arr_descriptor, $arr_closure);

			
			// Note our use of ===.  Simply == would not work as expected
			// because the position of 'a' was the 0th (first) character.
			if (is_array($diff) and count($diff)>0) {
				//esta dependencia no aporta al cierre
				$i ++;
			}else{
				//agrego lado derecho
				foreach ($arr_implicated as $key => $value) {
					# code...
					$arr_closure[] = $value;
				}
				//eliminar la relacion usada
				unset($arr_df[$i]);
				$arr_df = array_values ($arr_df);
				//Volver a recorrer el arreglo
				$i=0;
			}

			if ($i == count($arr_df)) {
				# code...
				$done=true;
			}
			
		}
		//se puede ordenar antes de devolverlo
		//sort($arr_closure);
		return array_unique($arr_closure);


	}

}


