<?php
        if(isset($_POST['envioPeli'])){
        include_once '../config/config.php';
        $conexion= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
        $sql="INSERT INTO peliculas VALUES ('' , '$_POST[nombre_peli]', '$_POST[fechaPeli]', '$_POST[director]', '$_POST[descripcion]');";
        $sql_resolv=mysqli_query($conexion, $sql)or die("No se pudo insertar los datos: ".mysqli_error($conexion));
        header("location: ../directorios/anidar.php");
        echo "<div>Datos insertados satisfactoriamente.</div>";


        }else{
            if(isset($_POST['anidar'])){
            include_once '../config/config.php';
            $conex=mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
            $sql="INSERT INTO salas_reproducen_pelis VALUES('$_POST[id]','$_POST[sala]','$_POST[hora]','$_POST[comienza]','$_POST[finaliza]')";
            $result=mysqli_query($conex, $sql) or die("No se pudo insertar los datos: ".mysqli_error($conex));
            header("location: ../directorios/addPelis.php");



        }else{

        if(isset($_POST['crearSala'])){
        include_once '../config/config.php';
        $conex=mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
        $sql="INSERT INTO salas VALUES ('$_POST[NSala]', '$_POST[descripcion]', '$_POST[nFilas]', '$_POST[nAsientos]');";
        $result=mysqli_query($conex, $sql) or die("No se pudo insertar los datos: ".mysqli_error($conex));
        header("location: ../directorios/addSalas.php");
        echo "<div>Sala creada correctamente</div>";

        }else{

              echo "<div>Compruebe que esté escrito correctamente los datos.</div>";
        }
        }
        }
?>
