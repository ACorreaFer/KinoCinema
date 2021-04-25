<?php
if(isset($_POST['NRegistro'])){
    include_once '../config/config.php';
    $conexion=  mysqli_connect($host, $user, $password, $db) or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
    $sql="INSERT INTO `usuarios` (`login`, `password`, `nombre`, `rol`) VALUES ('$_POST[login]', PASSWORD('$_POST[password]'), '$_POST[nombre]', 'Usuario');";
    mysqli_query($conexion, $sql) or die("Error al insertar Usuario ".mysqli_error($conexion));
    echo "Usuario registrado correctamente.";
    mysqli_close($conexion);
    header("location: ../index.php");
}else {
  echo "no existe el post";
}
?>
