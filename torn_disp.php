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
			<h2>Selecciona un torneo</h2>
			<table id="torneo_table">
				<?php
				$fecha = $_POST['filtroF'];
				$juego = $_POST['filtroJ'];
				$app = Aplicacion::getSingleton();
				$conn = $app->conexionBd();
				if($fecha != "" && $juego != "-1"){
					$query = sprintf("SELECT DISTINCT idJuego,dia_jugado FROM torneo_jugando t WHERE t.dia_jugado = '%s' AND t.idJuego = '%s'", $conn->real_escape_string($fecha), $conn->real_escape_string($juego));
				}
				else if($fecha == "" && $juego == "-1"){
					$query = sprintf("SELECT DISTINCT idJuego,dia_jugado FROM torneo_jugando");
				}
				else if($fecha != ""){
					$query = sprintf("SELECT DISTINCT idJuego,dia_jugado FROM torneo_jugando t WHERE t.dia_jugado = '%s'", $conn->real_escape_string($fecha));
				}
				else if($juego != "-1"){
					$query = sprintf("SELECT DISTINCT idJuego,dia_jugado FROM torneo_jugando t WHERE t.idJuego = '%s'", $conn->real_escape_string($juego));
				}
				 
				$rs = $conn->query($query);
				if($rs->num_rows >= 1){
					?>
					<tr>
						<th>Juego</th>
						<th>Fecha</th>
					</tr>
					<?php
					while($row = mysqli_fetch_assoc($rs)){
						$rows[] = $row;
					}
					for($i = 0; $i < count($rows); $i++){
						$idprod = $rows[$i]["idJuego"];
						$fecha = $rows[$i]["dia_jugado"];
						$producto = Product::buscaProduco($idprod);
						echo "<tr>";
						echo '<td><a href="mostrarClasif.php?id='.$idprod.'&fecha='.$fecha.'">' . $producto->nombreProd() . '</td>';
						echo "<td>" . $fecha . "</td>";
						echo "</tr>";
					}	
				}
				else{
					echo 'No hay datos.';
				}
				?>		
			</table>
		</div>
	</div>
</body>
</html>