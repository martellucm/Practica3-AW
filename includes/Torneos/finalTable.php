<?php
	$fecha = $_GET['fecha'];
	$juego = $_GET['id'];
	$ronda = 'final';
	$app = Aplicacion::getSingleton();
	$conn = $app->conexionBd();
	$query = sprintf("SELECT * FROM torneo_jugando t WHERE t.dia_jugado = '%s' AND t.idJuego = '%s' AND t.ronda = '%s'", $conn->real_escape_string($fecha), $conn->real_escape_string($juego), $conn->real_escape_string($ronda));
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
		while($row = mysqli_fetch_assoc($rs)){
			$rows[] = $row;
		}
		for($i = 0; $i < count($rows); $i++){
			$idprod = $rows[$i]["idJuego"];
			$producto = Product::buscaProduco($idprod);
			$usuario = Usuario::buscaUsuarioID($rows[$i]['id_jugad_jugan']);
			echo "<tr>";
			echo "<td>" . $fecha . "</td>";
			echo '<td>' . $producto->nombreProd() . '</td>';
			echo "<td>" . $usuario->nombreUsuario() . "</td>";
			echo "<td>Final</td>";
			echo "</tr>";
		}		
	}
	else{
		echo '<p>No hay datos para la final.</p>';
	}
?>
</table>