<?php
	require_once __DIR__.'/../comun/config.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__.'/torneo.php';

class RegistroTorneo extends Form {


	protected function procesaFormulario($datos){
			if (! isset($_POST['registro']) ) {
				header('Location: includes/Torneos/crearTorneo.php');
				exit();
			}

			$erroresFormulario = array();

			$idjuego = isset($datos['_id']) ? $datos['_id'] : null;
			var_dump($idjuego);

			if ( empty($idjuego)) {
				$erroresFormulario[] = "Id de juego no valida.";
			}

			$fecha = isset($datos['_fecha']) ? $datos['_fecha'] : null;
			if ( empty($fecha)) {
				$erroresFormulario[] = "fecha no valida.";
			}

			
			if (count($erroresFormulario) === 0) {
				$producto = Torneo::crea($idjuego, $fecha);
				if (! $producto ) {
					$erroresFormulario[] = "El producto ya existe";
				} else {
					return '../../torneo.php';
				}
			}

			return $erroresFormulario;
		}

	protected function generaCamposFormulario($datosIniciales){
			$fecha = '';
			$id = '';

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

				if(isset($datosIniciales['registro'])){
				$id = $datosIniciales['_id'];
				$fecha = $datosIniciales['_fecha'];
			}

			$html = '';
			$html .='	<fieldset>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Juego del torneo:</label> <select name=_id>';
								$app = Aplicacion::getSingleton();
						        $conn = $app->conexionBd();
								$query = sprintf("SELECT id, nombreProd FROM producto"); 
								$rs = $conn->query($query);
	       						$result = false;
								while ($row = mysqli_fetch_array($rs)) { 
								$nombre = $row["nombreProd"];
			$html .='			<option value ='. $row['id'].'>'.$nombre.'</option>' ;
								} 
			$html .='	</select>';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Fecha del Torneo:</label> <input class="control" type="date" name="_fecha" value="'.$fecha.'" required />';
			$html .='	</div>';

			$html .='	<div class="grupo-control"><button type="submit" name="registro">Añadir</button></div>';
			$html .='</fieldset>';
			return $html;
		}
}

?>

<div id="contenido">
	<h1>Registro de Torneo</h1>
<?php
		$formu = new RegistroTorneo('registro', array('action' => NULL));
		$formu->gestiona();
?>
</div>
