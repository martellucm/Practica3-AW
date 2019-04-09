<?php
require_once __DIR__ .'/includes/comun/config.php';
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
			<?php require'includes/comun/cabecera.php'; ?>
			<div>
				<h2>Filtro para mostrar los torneos</h2>
				<p>(si no desea filtrar, deje los valores por defecto)</p>
				<form class="" action="torn_disp.php" method="post">
					<label>Fecha del torneo</label>
					<input type="date" id="fecha" name="filtroF"  min="2018-03-25" max="2020-05-25" step="2">
					Seleccionar juego:
						<select name="filtroJ">
						<option value="0">vacio</option>
						<?php
						$app = Aplicacion::getSingleton();
						$conn = $app->conexionBd();
						$query = sprintf("SELECT * FROM producto");
						$rs = $conn->query($query);
					
						while($row = mysqli_fetch_assoc($rs)){
							$rows[] = $row;
						}
					
						for($i = 0; $i < count($rows); $i++){
							echo "<option value=".$rows[$i]["id"].">".$rows[$i]["nombreProd"]."</option>";
						}
						?>
					</select>
					<input type="submit" name="buscar" value="Realizar búsqueda">
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>