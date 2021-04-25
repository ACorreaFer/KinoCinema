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
        <div class="contenido"><img src="../estilos/recursos/Fondo1.jpg" id="cont" /></div>
    </body>
</html>

