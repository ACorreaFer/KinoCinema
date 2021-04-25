<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css" />
    </head>
    <body>
        <div class="contenidoAddPelis">
            <fieldset>
                <legend>ADMINISTRA TU CINE</legend>
                    <form method="POST" action="../controles/add.php">
                        Sala:<br /><input type="text" name="NSala" required /><br />
                        Número Asientos:<br /><input type="text" name="nAsientos" required /><br />
                        Número Filas:<br /><input type="text" name="nFilas" required /><br />
                        Descripcion:<br /><textarea rows="4" cols="50" name="descripcion"></textarea><br />
                        <br /><input type="submit" name="crearSala" />
                    </form>
            </fieldset>
        </div>   
    </body>
</html>
