<?php
include_once '../config/config.php';
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?1" />
        
    </head>
    <body>
      <div id="menu">
        <?php
            session_start();
            if(isset($_SESSION['login'])){
                    echo "<div id='usuario'> Bienvenido $_SESSION[login] </div>";
            }else{
                    session_destroy();
            }
        ?>
             <!-- Preguntar 
              <div id="info"><?php //echo $_GET['error']; ?></div> 
              -->
   
        
            <?php
                if($_SESSION['autenticado']==TRUE){
                            if($_SESSION['rol']=="Administrador"){
                                    echo "<a href='addPelis.php'>Añadir Estrenos</a>";
                                    echo "<a href='addSalas.php'>Añadir Salas</a>";
                            }else{
                                    echo "<a href='profiles.php'>Perfil</a>";
                                    echo "<a href='paginaPrincipal.php'>Página principal</a>";
                                    echo "<a href='cartelera.php'>Cartelera</a>";
                                    
                            }
                            echo "<a href='../controles/salir.php'>Cerrar Sesión</a>";	
            }
            ?>
        </div>
        </div>
        <div class="contenido">
            <div class="TCont">
                <?php  $fecha=date("Y-m-d");
                echo "<P> Cartelera del día ".$fecha;
                ?>
            </div>
        <table class="cartelera">
            <?php
            $conex= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conex));
            $sql="select n_sala from salas;";
            $resulSalas=  mysqli_query($conex, $sql);
            
             echo "<br /><tr class='tcabecera'>"
                . "<td>Sala</td>"
                . "<td>Película</td>"
                . "<td>Hora</td>"
                . "<td>Reserva tu sitio</td>"
                . "</tr><br />";
            
            while($sala=  mysqli_fetch_array($resulSalas,MYSQLI_ASSOC)){
                //Mostramos para cada sala que reproducciones se haran en la fecha dada
                $sql="Select r.id_peli, nombre, hora_reproduccion from peliculas as p,salas_reproducen_pelis as r"
                    . " where p.id_peli=r.id_peli and "
                        . "r.n_sala='$sala[n_sala]' and "
                        . "fecha_inicio<='$fecha' and "
                        . "fecha_fin>='$fecha';";
                $resulSesiones=  mysqli_query($conex, $sql) or die(mysqli_error($conex));
                
                   
                
                 
                while($sesion=  mysqli_fetch_array($resulSesiones,MYSQLI_ASSOC)){
                    echo "<tr> <td>Sala $sala[n_sala]</td>";
                    echo "<td>$sesion[nombre]</td><td> $sesion[hora_reproduccion]</td>"
                            . "<td><a href='sitio.php?n_sala=$sala[n_sala]&id_peli=$sesion[id_peli]&hora=$sesion[hora_reproduccion]&fecha=$fecha'>"
                            . "reserva </a>"
                            . "</td>";
                    
                }
                echo "</tr>";
            }
            $Reservas="Select ";
            $resulRes=mysqli_query($conex, $Reservas);
            
            ?>
        
            
        </table>
        </div>
    </body>
        
</html>