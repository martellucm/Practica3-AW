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
      <div class="saludo">
      <?php
        if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
          ?>
          <a href="crearProducto.php">Añadir </a>
          <?php
        }
        ?>
      </div>
      <div class="productos">
          <?php
            require_once __DIR__.'/includes/GestionProducto.php';
             GestionProducto::listadoProductos();
          ?>
      </div>
	 </div>
	</div>
</body>
</html>
