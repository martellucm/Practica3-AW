<?php
require_once __DIR__.'/includes/comun/config.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>My Chuster Games</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <meta charset="utf-8">
  </head>
<body>
  <div id ="contenedor">
  	<div id = "contenido">
	    <?php require'includes/comun/cabecera.php'?>
      <div class="tabla">
      <?php
         require_once __DIR__.'/includes/Torneos/results.php';
         MostrarResults::getPodium(16);
        ?>
      </div>
      <div class="podium">
         <?php
         require_once __DIR__.'/includes/Torneos/results.php';
         MostrarResults::getPodium(3);
        ?>
      </div>
	 </div>
	</div>
</body>
</html>
