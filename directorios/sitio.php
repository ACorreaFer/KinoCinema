<?php
    session_start();
     if(!isset($_SESSION['login'])){
         session_destroy();
         header("Location:../index.html");
         exit();
     }
  
    if(isset($_POST['reservar'])){
        include_once '../config/config.php';
        $conexion= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
        $arrayReservas=  explode(',', $_POST['datos']);
         $longitud=sizeof($arrayReservas);
         
        for($i=0;$i<$longitud;$i=$i+2){
            $sql="insert into usuario_reserva_sitio values('$_SESSION[login]','$_GET[id_peli]',"
                    ."'$_GET[n_sala]','$_GET[fecha]','$_GET[hora]','"
                    .$arrayReservas[$i+1]."','$arrayReservas[$i]');\n";
            mysqli_query($conexion, $sql) or die (mysqli_error($conexion));
            }
         
           
       
    }
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../estilos/estilos.css?1" />
    <script>
     reservas=new Array();
     
     function damePosicionDosElementosJuntos(uno,dos,miarray){
         var posicion=miarray.indexOf(uno);
         while(posicion!=-1){
         if(miarray[posicion+1]==dos)
             return posicion;
         posicion=miarray.indexOf(uno,posicion+1);        
        }
        return -1;
     }
     
     function marcaReserva(fila,columna){
           var miasiento=document.getElementById(fila+columna);
           var posicionArray;
         if(miasiento.className=='reservada'){
             miasiento.className="";//'td:actived';
             posicionArray=damePosicionDosElementosJuntos(fila,columna,reservas);
            if(posicionArray!=-1)
                reservas.splice(posicionArray,2);
             
         }else{
             reservas.push(fila,columna);
             miasiento.className='reservada';
        }
     }
     
     function mandarDatos(){
         if(reservas.length==0){
             alert("No tiene aún ningun asiento seleccionado");
             return false;
         }
         var Nododatos=document.getElementById('datos');
         Nododatos.value=reservas;
         return true;
         
     }
    </script>
  </head>
  <body>
    <table id="sala" border='1' width="3em" height="3em">
          
        
       <div id="menu">
        <?php
        
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
        
        
        <?php
            include_once '../config/config.php';
            if(!isset($_GET['n_sala'])){
                echo "<p>Sala no definida</p>";
            }else{   
                
            // Variables de conexion.
            $conex= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conex));
            
            // Variables de consulta de tablas.
            $nFila="select total_filas from salas where n_sala='$_GET[n_sala]';";
            $totalAsientos="select asientos_fila from salas where n_sala='$_GET[n_sala]';";

            // Variables de ejecución de consultas de tablas.
            $resFila=mysqli_query($conex, $nFila) or die ("Error en la consulta de numero total de filas de la sala. ".mysqli_error($conex));
            $resAsientos=mysqli_query($conex, $totalAsientos) or die ("Error en la consulta de numero total de asientos por fila. ".mysqli_error($conex));

            // Variables que contienen el resultado de las consultas.
            $f=  mysqli_fetch_array($resFila,MYSQLI_ASSOC)['total_filas'];
            $a=  mysqli_fetch_array($resAsientos,MYSQLI_ASSOC)['asientos_fila'];
            
            $sql="Select  n_fila, n_asiento  from usuario_reserva_sitio where n_sala='$_GET[n_sala]' and id_peli='$_GET[id_peli]' and "
                    . "fechaRes='$_GET[fecha]' and horaRes='$_GET[hora]'";
            $reservasSalaPeli=mysqli_query($conex, $sql) or die ("Error en las reservas. ".mysqli_error($conex));
            
            
            //$reservas=myslqi_fetch_all($reservasSalaPeli,MYSQLI_ASSOC);
            // Creando las tablas.
            // 1º for crea las filas.
            // 2º for crea las columnas.
                        
            echo "<div class=contenido>";
            echo "<div class='TCont'>RESERVA TU SITIO</div";
            for($i=1;$i<=$f;$i++){
                echo "<tr>";
                for($j=1;$j<=$a;$j++){
                    echo "<td onclick='marcaReserva(\"$i\",\"$j\");'id='$i$j'>$j</td>";
                }
                echo "</tr>";
            }
            
            while ( $value=mysqli_fetch_array($reservasSalaPeli,MYSQLI_ASSOC)) {
                echo "<script> "
                . "document.getElementById('$value[n_fila]$value[n_asiento]').className='inactiva';"
                . "document.getElementById('$value[n_fila]$value[n_asiento]').onclick='';"
                        . "</script>";
                
                
            }             
            
            }//else
            echo "</div>";
        ?>
        <form action="" method="POST" onsubmit="return mandarDatos();">
            <input type="hidden" name="datos" id="datos"/>
            <input type="submit" value="reservar" name="reservar" id="reservar" />
        </form>
        
    </table>
  </body>
</html>
