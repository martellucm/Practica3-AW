<?php
	require_once __DIR__.'/../comun/config.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__.'/../productos/Producto.php';

class RegistroTorneo extends Form {


	protected function procesaFormulario($datos){
			if (! isset($_POST['registro']) ) {
				header('Location: includes/Torneos/crearTorneo.php');
				exit();
			}

			$erroresFormulario = array();

			$nombreProducto = isset($datos['_nombreProducto']) ? $datos['_nombreProducto'] : null;

			if ( empty($nombreProducto) || mb_strlen($nombreProducto) < 1 ) {
				$erroresFormulario[] = "El nombre del producto tiene que tener una longitud de al menos 1 caracter.";
			}

			$descrip = isset($datos['_descrip']) ? $datos['_descrip'] : null;
			if ( empty($descrip) || mb_strlen($descrip) < 5 ) {
				$erroresFormulario[] = "La descripción tiene que tener una longitud de al menos 5 caracteres.";
			}

			$edad = isset($datos['_edad']) ? $datos['_edad'] : null;
			if ( empty($edad)) {
				$erroresFormulario[] = "Introduce la edad recomendada";
			}
			$jugadores = isset($datos['_jugadores']) ? $datos['_jugadores'] : null;
			if ( $jugadores  == 0) {
				$erroresFormulario[] = "Debe introducir el numero de jugadores.";
			}

			$link = isset($datos['_link']) ? $datos['_link'] : null;
			if ( empty($link)) {
				$erroresFormulario[] = "Debe introducir el link de compra.";
			}

			$empresa = isset($datos['_empresa']) ? $datos['_empresa'] : null;
			if ( empty($empresa)) {
				$erroresFormulario[] = "Imtroduce el nombre de la empresa propietaria.";
			}

			//$img = isset($datos['_image']) ? $datos['_image'] : null;

			if (count($erroresFormulario) === 0) {
				$producto = Product::crea($nombreProducto, 0, $descrip, $edad, $jugadores,$link,$empresa, '0');
				if (! $producto ) {
					$erroresFormulario[] = "El producto ya existe";
				} else {
					return 'prodtabla.php';
				}
			}

			return $erroresFormulario;
		}

	protected function generaCamposFormulario($datosIniciales){
			$fecha = '';

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

				if(isset($datosIniciales['registro'])){
				$nombrProd = $datosIniciales['_nombreProducto'];
				$descrip = $datosIniciales['_descrip'];
				$edad = $datosIniciales['_edad'];
				$jugadores = $datosIniciales['_jugadores'];
				$link = $datosIniciales['_link'];
				$empresa = $datosIniciales['_empresa'];
				//$img = $datosIniciales['_image'];
			}

			$html = '';
			$html .='	<fieldset>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Juego del torneo:</label> <select name=lista>';
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
			$html .='		<label>Fecha del Torneo:</label> <input class="control" type="date" name="cumple" value="'.$fecha.'" required />';
			$html .='	</div>';

			$html .='	<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>';
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
