<table id="qualifyingTable">
  <tr>
	<th>Fecha</th>
    <th>Juego</th>
    <th>Usuario</th>
  </tr>
  <?php
	$fecha = $_GET['filtroF'];
	$juego = $_GET['filtroJ'];
	if($fecha != "no" && $juego != "no"){
		$query = mysql_query("SELECT * FROM torneo_jugando t WHERE t.dia_jugado = $fecha, t.idJuego = $juego AND t.ronda = clasificacion") or die(mysql_error());
	}
	else if($fecha != "no"){
		$query = mysql_query("SELECT * FROM torneo_jugando t WHERE t.dia_jugado = $fecha AND t.ronda = clasificacion ORDER BY t.idJuego ASC") or die(mysql_error());
	}
	else if($juego != "no"){
		$query = mysql_query("SELECT * FROM torneo_jugando t WHERE t.idJuego = $juego AND t.ronda = clasificacion ORDER BY t.dia_jugado ASC") or die(mysql_error());
	}
	else{
		$query = mysql_query("SELECT * FROM torneo_jugando AND t.ronda = clasificacion ORDER BY t.dia_jugado ASC") or die(mysql_error());
	}
    $data = mysql_fetch_array($query); 
	
	foreach($data as $cursor){
		$producto = Producto::buscaProductoID($cursor['idJuego']);
		$usuario = Usuario::buscaUsuarioID($cursor['id_jugad_jugan']);
		echo "<tr>";
		echo "<td>" . $cursor['dia_jugado'] . "</td>";
		echo "<td>" . $producto->nombreProd() . "</td>";
		echo "<td>" . $usuario->nombreUsuario() . "</td>";
		echo "</tr>";
	}	
  ?>
</table>