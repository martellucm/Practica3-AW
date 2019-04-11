<?php
	$fecha = $_GET['fecha'];
	$juego = $_GET['id'];
	$app = Aplicacion::getSingleton();
	$conn = $app->conexionBd();
	$query = sprintf("SELECT DISTINCT  * FROM torneo_jugando t WHERE t.dia_jugado = '%s' AND t.idJuego = '%s' AND t.ronda = 'final'", $conn->real_escape_string($fecha), $conn->real_escape_string($juego));
	$rs = $conn->query($query);
	if($rs->num_rows >= 1){
	?>
	<table id="qualifyingTable">
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
			if($fila['ronda'] == "final"){
				echo "<tr>";
				echo "<td>" . $fecha . "</td>";
				echo '<td>' . $producto->nombreProd() . '</td>';
				echo "<td>" . $usuario->nombreUsuario() . "</td>";
				echo "<td>Final</td>";
				echo "</tr>";
			}
		}
	}
	else{
		echo '<p>No hay datos para la final.</p>';
	}
?>
</table>
