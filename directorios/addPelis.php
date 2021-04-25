<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?1" />
    </head>
    <body>
        <div class="contenidoAddPelis">
            <fieldset>
                <legend>ADMINISTRA TU CINE</legend>
                    <form method="POST" action="../controles/add.php">
                        Nombre<br /><input type="text" name="nombre_peli" required /><br />
                        Director<br /><input type="text" name="director" required /><br />
                        Fecha<br /><input type="text" name="fechaPeli" /><br />
                        Descripción<br /><textarea rows="4" cols="50" name="descripcion" ></textarea><br />
                        <br /><input type="submit" name="envioPeli" />
                    </form>
            </fieldset>
            <fieldset>
                <table>
                    <?php
                    include_once '../config/config.php';
                     $conexion= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
                     $sql="Select id_peli,nombre,fecha_peli,director from peliculas";
                     $resul=  mysqli_query($conexion, $sql);
                     // Escribimos la tabla
                     while($fila=  mysqli_fetch_array($resul,MYSQLI_ASSOC)){
                         echo "<tr>";
                         foreach ($fila as $key => $value) {
                             echo "<td>$value</td>";
                         }
                         echo "<td><a href='../controles/borra.php?tabla=peliculas&id_peli=$fila[id_peli]'>borra</a></td>";
                         echo "</tr>";
                         
                     } 
                     
                     ?>
                    
                    
                </table>
                
            </fieldset>
            <a id="volver" href="paginaPrincipal.php">Volver a la pagina principal</a>
        </div>   
    </body>
</html>
