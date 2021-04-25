<?php
if(isset($_POST['autentica'])){ // Verificamos que venimos del formulario de autenticacion
    include_once '../config/config.php';
    $conexion= mysqli_connect($host, $user, $password, $db)  or die("<br>Error en la conexion con la BD ".mysqli_error($conexion));
    $login = mysqli_real_escape_string($conexion,$_POST['login']);
    $pass = mysqli_real_escape_string($conexion,$_POST['password']);
    $sql="Select * from usuarios where login='$login' and password=PASSWORD('$pass');";


    $resultado= mysqli_query($conexion, $sql) or die(mysqli_error($conexion));//
    $numFilas=  mysqli_num_rows($resultado);


    //Comprobacion de que que se devuelve una fila
    if($numFilas==1){
    $fila=  mysqli_fetch_array($resultado,MYSQLI_ASSOC);
    session_start();
    //Crea una sesion o la propaga
    //Fijamos las credenciales de sesion
    $_SESSION['autenticado']=TRUE;
    $_SESSION['login']=$_POST['login'];
    $_SESSION['rol']=$fila['rol'];
    //Aqui falta decidir donde enviamos al usuario
   header("Location: ../directorios/paginaPrincipal.php");
    //echo "He verificado la autenticacion";

}else{
    //echo"Ha fallado la autenticacion";
    header("Location: ../index.php?error=Comprueba login y password");}


}

?>
