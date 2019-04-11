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
	    <div id = "news">
	       <?php require'includes/estructura/leftnews.php'?>
	    </div>
	    <div id = "publi">
        <img class="foto_publi" src="img/publi.jpg">
      </div>
	 <div id="winners">
		   	<div id = "month">
		        <h2>Ganador del mes</h2>
			    <?php
		        require_once __DIR__.'/includes/usuarios/GestionaUsuario.php';
		           GestionUsuario::mostrarWW();
			      ?>
		        </div>
		    <div id = "week">
		        <h2>Ganador de la semana</h2>
					<?php
						GestionUsuario::mostrarWW();
					?>
			</div>
		</div>
    <div class = "productosind">
    	<h2>Juegos destacados</h2>
        <?php
          require_once __DIR__.'/includes/productos/GestionProducto.php';GestionProducto::mejoresProductos('3');
        ?>
    </div>
	</div>
</body>
</html>
