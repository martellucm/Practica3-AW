<?php
require_once __DIR__ .'/../comun/config.php';
require_once __DIR__ .'/../productos/Producto.php';
?>
<div id="torneos_jug">
	<h2>Torneos disponibles</h2>
	<table class="torneo_table">
		<tr>
		    <th>Juego</th>
		    <th>Fecha</th>
	 	</tr>
		<?php
		$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM torneo_jugando t WHERE t.ronda = '%s'", $conn->real_escape_string("clasificacion"));
        $rs = $conn->query($query);
		
		
		$data = $rs->fetch_assoc();
		foreach($data as $cursor){
			$idprod = @$cursor["idJuego"];
			$fecha = @$cursor["dia_jugado"];
			$producto = Product::buscaProduco($idprod);
			echo "<tr>";
			echo "<td>" . $producto->nombreProd() . "</td>";
			echo "<td>" . $fecha . "</td>";
			echo "</tr>";
	}	
		?>		
	</table>
</div>