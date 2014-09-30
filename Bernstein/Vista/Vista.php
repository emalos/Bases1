<?php

//Aqui va la vista
class Vista{



  function getHtml($arr_final){
  
    $html = '';
    foreach ($arr_final as $key=>$value){
    $html .= "<tr>";
      $value = str_replace("|","->",$value);
      $html .="<td>$value</td>"; 
       $html .= "</tr>";
    }
   
    return $html;

  }

}