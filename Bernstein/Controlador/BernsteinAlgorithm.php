

<?php


require_once 'ReduceRedundance.php';
require_once 'RemoveStrange.php';
require_once 'Closure.php';

class BernsteinAlgorithm{

	private $obj_closure;
	private $obj_del_strange;
	private $obj_del_redundatn;

	function __construct(){

		
		
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

//Cierre de F
$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
foreach ($arr_test as $key => $value) {
	# code...
	list($descriptor,$implicated) = explode("|", $value);
	$arr_cierre = cierre($arr_test,$descriptor);
	$new_implicated = implode(",", $arr_cierre);
	echo "$descriptor|$new_implicated\n";


}

//Eliminar Extraños

echo"Sin elemento extraño: \n";
$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
foreach ($arr_test as $key => $value) {
	# code...
	list($x,$y) = explode("|", $value); 
	$arr_del = delIzq($arr_test,$x);
	//print_r($arr_del);
	$algo = implode(",", $arr_del);
	$arr_no_strange[] = "$algo|".$y;
}

print_r($arr_no_strange);


//Cierre de F
$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
foreach ($arr_no_strange as $key => $value) {
	# code...
	list($descriptor,$implicated) = explode("|", $value);
	$arr_cierre = cierre($arr_no_strange,$descriptor);
	$new_implicated = implode(",", $arr_cierre);
	$arr_new_close[] =  "$descriptor|$new_implicated";


}
echo "Cierre\n";
print_r($arr_new_close);
//(array("H|I,O", "O|H,O", "K,M|L", "L|M,K", "M|K", "H,K|M"),"O,M");


//Eliminar redundancias
echo "Redundancias\n";

$arr_test = array("A,B,C|E", "F,D|A", "A,G|E", "D|C", "B,C|F", "A|H", "F|D", "H|G");
//$arr_df = explode("|", $arr_test);
$arr_result = delRedundant($arr_no_strange);
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


function delRedundant($arr_df){


	foreach ($arr_df as $key => $value) {
		# code...
		list($descriptor,$implicated) = explode("|", $value);
		$arr_tmp = $arr_df;
		//Elimino el descriptor, al que le busco el cierre, del conjunto de dependencias
		unset($arr_tmp[$key]);
		//print_r($arr_tmp);
		$arr_new_dep = array_values($arr_tmp);
		//print_r($arr_new_dep);
		$arr_cierre = cierre($arr_new_dep,$descriptor);
		$str_cierre[] = $descriptor."|".(implode(",", $arr_cierre));

	}

return $str_cierre;
}

//exit;


//Eliminar atributos extraños lado izq
//Elimina uno a uno los atributos del determinante para ver si es obtienen en el cierre

function delIzq($arr_df,$atribute){

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
		echo "$arr_df,$new_atribute\n";
		$arr_cierre = cierre($arr_df,$new_atribute);
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
//print_r($arr_final);

	// $arr_atribute = explode(",", $atribute);
	// $limit = count($arr_atribute);
	// $arr_final = $arr_atribute;
	// foreach ($arr_atribute as $key => $value) {
	// 	# code...
	// 	$arr_work = $arr_atribute;
	// 	unset($arr_work[$key]);
	// 	$arr_new = array_values($arr_work);
	// 	$new_atribute = implode(",", $arr_new);
	// 	//echo "$arr_df,$new_atribute";
	// 	$arr_cierre = cierre($arr_df,$new_atribute);
	// 	$bol_strange = in_array($value, $arr_cierre);
	// 	$arr_cierres[]=$arr_cierre;
	// 	if ($bol_strange) {
	// 		# code...
	// 		//eliminar ese elemento
	// 		unset($arr_final[$key]);

	// 	}

	// }
	return array_values($arr_final);
}


function cierre($arr_df,$atribute){

	$i=0;
	$done=false;
	//$atribute = str_replace(",", "", $atribute);
	//separo en un array el descriptor
	$arr_atribute = explode(",", $atribute);
	//inicializo el cierre
	$arr_closure = $arr_atribute;
	//echo "$closure ";
	while ( $done===false) {
		# code...

		$arr_dependency = explode("|", $arr_df[$i]);
		//implicante
		//$arr_descriptor = str_replace(",", "", $arr_dependency[0]); //$arr_dependency[0];//
		$arr_descriptor = explode(",", $arr_dependency[0]);
		//implicado
		//$arr_implicated = str_replace(",", "", $arr_dependency[1]); //$arr_dependency[1];//
		$arr_implicated = explode(",", $arr_dependency[1]);

		//$pos = strpos($closure, $arr_descriptor);

// echo "cierre vs descriptor\n";
// var_dump($arr_closure);
//var_dump($arr_descriptor);

		//Comparamos el descriptor con el cierre
		$diff = array_diff($arr_descriptor, $arr_closure);

		
		// Note our use of ===.  Simply == would not work as expected
		// because the position of 'a' was the 0th (first) character.
		if (/*$pos === false*/ is_array($diff) and count($diff)>0) {
			//esta dependencia no aporta al cierre
			//echo " NADA\n";
			$i ++;
		}else{
			//agrego lado derecho
			foreach ($arr_implicated as $key => $value) {
				# code...
				$arr_closure[] = $value;
			}
			//$closure[] = $arr_implicated;
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
		//echo " $i : $closure, $arr_descriptor";
		//print_r($arr_df);


	}
	//se puede ordenar antes de devolverlo
	//sort($arr_closure);
	return array_unique($arr_closure);


}