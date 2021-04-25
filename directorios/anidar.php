<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css" />
    </head>
    <body>
        <div class="contenidoAddPelis">
            <fieldset>
                <legend>ANEXAR A UNA SALA</legend>
                    <form method="POST" action="../controles/add.php">
                        ID Película:<br /><input type="text" name="id" required /><br />
                        Sala:<br /><input type="text" name="sala" required /><br />
                        Hora<br /><input type="text" name="hora" required/><br />
                        Comienza<br /><input type="text" name="comienza" required/><br />
                        Finaliza<br /><input type="text" name="finaliza" required/><br />
                        <br /><input type="submit" name="anidar" />
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
                    </form>
                <a id="volver" href="paginaPrincipal.php">Volver a la pagina principal</a>
            </fieldset>
             
        </div>   
    </body>
</html>