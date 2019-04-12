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
	<br>
	<div id="bttn_tour">
		<div  class="addnoticia">
			<a href="mostrarTorneos.php">Ver Torneo</a>
			<a href="mostrarResults.php">Resultados</a>
		</div>
	</div>
	<br>
	<?php
	 if(isset($_SESSION['login'])){
		 require 'includes/Torneos/viernesSel.php';
		 require 'includes/Torneos/inscri_tourn.php';
     if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
       echo '<a href="includes/Torneos/crearTorneo.php"><button> Añadir Torneo </button></a>';
     }
	 }
	?>

</body>
</html>
