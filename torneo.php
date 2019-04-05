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
  	   <?php require'includes/comun/cabecera.php'?>
  	<div id = "contenido">
  	<h1>Torneos</h1>
	<div id="bttn_tour">
		<a href=""><button >Ver Torneo</button></a>
		<a href="mostrarResults.php"><button >Resultados</button></a>
	</div>
	<?php
	 require 'includes/Torneos/torn_disp.php';
	 if(isset($_SESSION['login'])){
		 require 'includes/Torneos/viernesSel.php';
		 require 'includes/Torneos/inscri_tourn.php';
		 require 'includes/Torneos/act_punt.php';
	 }
	?>

</body>
</html>