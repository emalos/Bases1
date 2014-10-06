<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 300);

// print_r($_REQUEST);


session_start();


// if(!isset($obj_file)){
// require_once 'Modelo/FileControl.php';
// 
// 	$obj_file = new FileControl("",null);
// }else{
// echo "si esta";
// }

if (isset($_FILES['userfile']) and isset($_REQUEST["send"])) {
	# code...
	require_once 'Modelo/FileControl.php';

	$obj_file = new FileControl("",null);

	list($name,$response) = $obj_file -> checkFile($_FILES);
	$_SESSION['fileName']=$name;

}elseif (isset($_REQUEST["execute"])) {
	# code
	require_once 'Modelo/FileControl.php';
	require_once 'Vista/Vista.php';
	require_once 'Controlador/BernsteinAlgorithm.php';

	$obj_controller = new BernsteinAlgorithm();
	
	$obj_file = new FileControl("",$obj_controller);

	$result = $obj_file -> loadFile($_SESSION['fileName']);

	$result = $obj_file -> processXml();
	
	$obj_view = new Vista();
	$html = $obj_view -> getHtml($result);
// 	print_r($result);

}


?>	


	<html>
    <head>
        <title>Bernstein</title>
    </head>
    <body>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <center>
            <h1>Sintesis de Bernstein</h1>
            <ol>
                <li>
                    Hallar un recubrimiento minimal DFm
                </li>
                <li>
                    Agrupar las DF en particiones que tienen el mismo implicante, uniendo los atributos equivalentes
                </li>
                <li>
                    Crear un esquema Ri para cada partici&oacute;n, que tenga como atributos todos los que participen en las dependencias y como grupo de dependencias las del grupo.
                </li>
                <li>
                    Si existen atributos que no son implicantes ni implicados, formar un esquema de relaci&oacute;n con estos sin dependencias o alternativamente crear un esquema con la clave de la relaci&oacute;n sin dependencias.
                </li>
            </ol>
            <br/>
            <br/>
            <table>
                <tr>
                    <td>
                        Por favor seleccione el archivo a validar
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="userfile" type="file">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="send" value="Enviar">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if(isset($response)) echo $response.'
                        <tr>
                    <td>
                        <input type="submit" name="execute" value="Ejecutar">
                    </td>
                </tr>';?>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <?php if(isset($html)) echo $html;?>
                    </td>
                </tr>
            </table>
            </center>
        </form>        
    </body>
 
</html>