<html>
    <head>
        <title>Bernstein</title>
    </head>
    <body>
        <form action="../Controlador/procesarArchivo.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
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
                        <input type="submit" value="Enviar">
                    </td>
                </tr>
            </table>
            </center>
        </form>        
    </body>
 
</html>