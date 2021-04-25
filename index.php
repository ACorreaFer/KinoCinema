<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="estilos/cssIndex.css?1" />
    <script type="text/javascript" src="javascript/javascript.js"></script>
  </head>
  <body>
    <img id="background" src="estilos/recursos/entrada.jpg" />
    <div class="contenedor">
        <div id='logueo'>
            <form method="POST" action="controles/control.php" onsubmit="return validar(this);">
                    <div class='compIzq'>
                        Usuario<input type='text' name='login' class="campo" />
                        Clave<input type='password' name='password' class="campo" />
                    </div>
                    <div class='compDer'>
                      <input type="submit" id="submit" name="autentica" value="Entrar"/>
                    </div>
                    <div id='sublogin'>
                        <a href='forget.php'>¿Has olvidado tu contraseña?</a>
                        <a href='directorios/signup.php'>¿Aun no tienes una cuenta? Pulse aquí</a>
                    </div>
            </form>
        </div>
    </div>
  </body>
</html>
