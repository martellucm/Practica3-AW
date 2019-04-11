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
  	<div id = "filtro">
	    <?php require'includes/comun/cabecera.php'?>
      <div>
        <h2>Filtro para mostrar los torneos</h2>
        <p></p>
        <form class="" action="mostrarResults.php" method="post">
          <label>Fecha del torneo</label>
          <input type="date" id="fecha" name="filtroF"  min="2018-03-25" max="2020-05-25">
          Seleccionar juego:
            <select name="filtroJ">
            <option value="-1">Los mejores</option>   
             <?php
               require_once __DIR__.'/includes/Torneos/GestionaTorneo.php';
               GestionaTorneo::filtarPorDefecto();
              ?>         
            </select>
          <input type="submit" name="buscar" value="Realizar búsqueda">
        </form>
        <div id = "contenido">
         <?php @require'tablaResults.php'?>
         </div>
      </div>
	 </div>
	</div>
</body>
</html>
