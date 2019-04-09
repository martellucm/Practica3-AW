<?php
require_once __DIR__ .'/../comun/config.php';
require_once __DIR__ .'/../productos/Producto.php';
require_once __DIR__ .'/../usuarios/Usuario.php';
?>
<div id="torneos_jug">
	<h2>Selecciona un torneo</h2>
	<table class="torneo_table">
		<?php
		$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM torneo_jugando t WHERE t.ronda = '%s'", $conn->real_escape_string("clasificacion"));
        $rs = $conn->query($query);
		if($rs){
			?>
			<tr>
				<th>Juego</th>
				<th>Usuario</th>
				<th>Fecha</th>
			</tr>
			<?php
			while($row = mysqli_fetch_assoc($rs)){
				$rows[] = $row;
			}
			for($i = 0; $i < count($rows); $i++){
				$idprod = $rows[$i]["idJuego"];
				$idUsu = $rows[$i]["id_jugad_jugan"];
				$fecha = $rows[$i]["dia_jugado"];
				$producto = Product::buscaProduco($idprod);
				$usuario = Usuario::buscaUsuarioID($idUsu);
				echo "<tr>";
				echo "<td>" . $producto->nombreProd() . "</td>";
				echo "<td>" . $usuario->nombreUsuario() . "</td>";
				echo "<td>" . $fecha . "</td>";
				echo "</tr>";
			}	
		}
		?>		
	</table>
</div>