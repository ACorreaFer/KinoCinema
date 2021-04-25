<?php

//Te falta poner la seguridad para que el administrador
session_start();
if($_SESSION['rol']!='Administrador'){
    //echo "No eres administrador";
    // session_destroy();
    header("Location:../index.php");
    exit();
}
if(isset($_GET['tabla'])){
    include_once '../config/config.php';
        $conexion= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
        $sql="delete from $_GET[tabla] where ";
        foreach ($_GET as $key => $value) {
            if ($key!='tabla'){
                $sql.="$key='$value' ";
            }
        }
        $sql.=";";
        mysqli_query($conexion, $sql) or die("error al borrar el elemento".mysqli_error($conexion));
        echo " Elemento eliminado vuelva a la página origen".$sql;
        
}