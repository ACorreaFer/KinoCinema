<?php
/*
 *   Fichero para la implantación de la base de datos.
 *
 */
include_once 'config/config.php';
echo "Conectando:";
$conex=mysqli_connect($host,$user,$password)or die("Fallo en la conexión");
$consulta="CREATE DATABASE IF NOT EXISTS $db;";
echo "OK.<BR> Creando BD:";
mysqli_query($conex,$consulta) or die("fallo al crear la base de datos:".mysqli_error($conex));

mysqli_select_db($conex,$db);
$crea_Us=<<<EOF
CREATE TABLE IF NOT EXISTS `usuarios`(
  `login` VARCHAR(16) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `nombre` VARCHAR(16) NOT NULL,
  `rol` SET('Administrador','Usuario') NOT NULL,
  PRIMARY KEY(`login`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
EOF;

$crea_Salas=<<<EOF
CREATE TABLE IF NOT EXISTS `salas`(
  `n_sala` INT(2) NOT NULL,
  `descripcion` text(800),
  `total_filas` int(2),
  `asientos_fila` int(2),
  PRIMARY KEY(`n_sala`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
EOF;

$crea_Pelis=<<<EOF
CREATE TABLE IF NOT EXISTS `peliculas`(
  `id_peli` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(32) NOT NULL,
  `fecha_peli` VARCHAR(10) NOT NULL,
  `director` VARCHAR(16) NOT NULL,
  `descripcion` TEXT(800),
  PRIMARY KEY(`id_peli`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
EOF;

  $crea_Reservas=<<<EOF
  CREATE TABLE IF NOT EXISTS `usuario_reserva_sitio`(
    `login` VARCHAR(16) NOT NULL,
    `id_peli` INT,
    `n_sala` INT(2),
    `fechaRes` date,
    `horaRes` time,
    `n_asiento` int(2),
    `n_fila` int(2),
    PRIMARY KEY(`login`,`id_peli`,`n_sala`,`fechaRes`,`horaRes`,`n_asiento`,`n_fila`),
    FOREIGN KEY(`id_peli`) REFERENCES peliculas(`id_peli`),
    FOREIGN KEY(`n_sala`) REFERENCES salas(`n_sala`)
    )ENGINE = InnoDB CHARSET = latin1;
EOF;

  $crea_Reproduce=<<<EOF
  CREATE TABLE IF NOT EXISTS `salas_reproducen_pelis`(
    `id_peli` INT,
    `n_sala` INT(2),
    `hora_reproduccion` TIME,
    `fecha_inicio` DATE,
    `fecha_fin` DATE,
    PRIMARY KEY(`id_peli`,`n_sala`,`hora_reproduccion`),
    FOREIGN KEY(id_peli)REFERENCES peliculas(id_peli),
    FOREIGN KEY(n_sala)REFERENCES salas(n_sala)
    )ENGINE = InnoDB CHARSET = latin1;
EOF;

echo " OK.<br>Creando tabla salas:";
mysqli_query($conex,$crea_Salas) or die (" FAIL ".mysqli_error($conex));
echo " OK.<br>Creando tabla peliculas:";
mysqli_query($conex,$crea_Pelis) or die (" FAIL ".mysqli_error($conex));
echo " OK.<br>Creando tabla usuarios:";
mysqli_query($conex,$crea_Us) or die(" FAIL ".mysqli_error($conex));
echo " OK.<br> Insertando usuario admin 1234:";
$crea_Us = "INSERT INTO `usuarios` (`login`, `password`,`rol`) VALUES ('admin', PASSWORD('1234'),'Administrador');";
mysqli_query($conex,$crea_Us) or die(", fallo al insertar admin.");
echo " OK.<br> Creando tabla reservas:";
mysqli_query($conex,$crea_Reservas) or die (" FAIL ".mysqli_error($conex));
echo " OK.<br> Creando tabla reproduce:";
mysqli_query($conex,$crea_Reproduce) or die(" FAIL".mysqli_error($conex));
echo " OK.";
echo "<br>--- FIN DE INSTALACION ---"

?>
