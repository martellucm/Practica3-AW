<table id="qualifyingTable">
  <?php
	$fecha = $_GET['fecha'];
	$juego = $_GET['id'];
	$ronda = 'clasificacion';
	$app = Aplicacion::getSingleton();
	$conn = $app->conexionBd();
	$query = sprintf("SELECT * FROM torneo_jugando t WHERE t.dia_jugado = '%s' AND t.idJuego = '%s'", $conn->real_escape_string($fecha), $conn->real_escape_string($juego));
	$rs = $conn->query($query);
	if($rs->num_rows >= 1){
	?>
		<tr>
			<th>Fecha</th>
			<th>Juego</th>
			<th>Usuario</th>
			<th>Ronda</th>
		</tr>
		<?php
		$rows = NULL;
		while($row = mysqli_fetch_assoc($rs)){
			$rows[] = $row;
		}
		foreach($rows as $fila){
			$idprod = $fila["idJuego"];
			$producto = Product::buscaProduco($idprod);
			$usuario = Usuario::buscaUsuarioID($fila['id_jugad_jugan']);
			echo "<tr>";
			echo "<td>" . $fecha . "</td>";
			echo '<td>' . $producto->nombreProd() . '</td>';
			echo "<td>" . $usuario->nombreUsuario() . "</td>";
			echo "<td>Clasificación</td>";
			echo "</tr>";
		}
	}
	else{
		echo 'No hay datos.';
	}
?>
</table>
