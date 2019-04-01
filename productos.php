<?php
require_once __DIR__.'/includes/config.php';
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
	    <div id = "news">

	       <?php require'leftnews.php'?>
	    </div>
      <div id = "reacciones">
           <?php 
           require_once __DIR__.'/includes/ReaccionesProducto.php';
           Valoracion::setPuntuacion($_GET['id']);
            ?>
      </div>
      <div id = "producto_total">
           <?php require 'includes/muestraProducto.php' ?>
      </div>
	 </div>   
	</div>
</body>
</html>