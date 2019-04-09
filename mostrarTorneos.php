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
			<?php require'includes/comun/cabecera.php'; ?>
			<div>
				<h2>Filtro para mostrar los torneos</h2>
				<p>(si no desea filtrar, deje los valores por defecto)</p>
				<div class="fecha">Fecha: <input id="date" type="date"></div>
				<p></p>
				<p>Seleccionar juego:
					<select>
					<option value="0">Selección:</option>
					<?php
 
					$query = $mysqli -> query ("SELECT * FROM producto");
 
					while ($valores = mysqli_fetch_array($query)) {
						
						echo '<option value="'.$valores[nombreProd].'">'.$valores[nombreProd].'</option>';
 
					}
        ?>
					</select>
				<button>Enviar</button>
				</p>
			</div>
		</div>
	</div>
</body>
</html>