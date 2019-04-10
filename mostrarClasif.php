<?php
require_once __DIR__ .'/includes/comun/config.php';
require_once __DIR__ .'/includes/productos/Producto.php';
require_once __DIR__ .'/includes/usuarios/Usuario.php';
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
		<div id="torneos_jug">
			<?php require'includes/comun/cabecera.php'; ?>
			<h2>Mostrando la clasificación</h2>
				<?php
				require'includes/torneos/qualifyingTable.php';
				require'includes/torneos/semisTable.php';
				require'includes/torneos/finalTable.php';
				?>
				<?php 
				if(isset($_SESSION['login']) && $_SESSION['login'] == true){
				$usuario = Usuario::buscaUsuario($_SESSION["nombre"]);
				$fecha = $_GET['fecha'];
				$idProd = $_GET['id'];
				?>
				<form action="includes/torneos/pasaRondas.php" method="post" id="nextRound">
					<input type="hidden" name="idJug" value="<?php echo $usuario->id(); ?>" />
					<input type="hidden" name="idProd" value="<?php echo $idProd; ?>" />
					<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" />
				</form>
				<button type="submit" form="nextRound" value="Submit">Pasar de ronda</button>
				<?php }?>
		</div>
	</div>
</body>
</html>