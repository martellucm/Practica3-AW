<?php
	require_once __DIR__.'/../comun/config.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__.'/Usuario.php';

class ModifUsu extends Form {


	protected function procesaFormulario($datos){
			$id3 = $datos['_id'];
			if (! isset($_POST['modificarusu']) ) {
				header('Location: userTabla.php.php');
				exit();
			}

			$erroresFormulario = array();

			$nombre = isset($datos['_nombre']) ? $datos['_nombre'] : null;

			if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
				$erroresFormulario[] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
			}

			$email = isset($datos['_email']) ? $datos['_email'] : null;
			if ( empty($email)) {
				$erroresFormulario[] = "Debe introducir un correo electrónico.";
			}
			$cumple = isset($datos['_cumple']) ? $datos['_cumple'] : null;
			if ( empty($cumple)) {
				$erroresFormulario[] = "Debe introducir su fecha de nacimiento.";
			}
			$descrip = isset($datos['_descrip']) ? $datos['_descrip'] : null;
			if ( empty($descrip) || mb_strlen($descrip) < 5 ) {
				
				$erroresFormulario[] = "¡No seas tímido! Cuéntanos algo sobre ti.";
			}
			
			

			if (count($erroresFormulario) === 0) {
				
				Usuario::actualizaUsu($id3, $nombre, $email, $descrip, $cumple);
				return 'userTabla.php';			}

			return $erroresFormulario;
		}

	protected function generaCamposFormulario($datosIniciales){
		$usuario="";
		if(!isset($_POST['modificarusu']))
		 	{
		 		$id = $_GET['id'];
		 	    $usuario = Usuario::buscaUsuarioID($id);
		 	}
		 	else{
		 		$usuario= Usuario::buscaUsuarioID($datosIniciales['_id']);
		 	}

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

				
				$datosIniciales['_id'] = $usuario->id();
				$datosIniciales['_nombre'] = $usuario->nombre();
				$datosIniciales['_email'] = $usuario->email();
				$datosIniciales['_descrip'] = $usuario->descrip();
				$datosIniciales['_cumple'] = $usuario->cumple();
			

			$html = '';
			$html .='	<fieldset>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Nombre completo:</label> <input class="control" type="text" name="_nombre" value="'.$usuario->nombre() .'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Correo electrónico:</label> <input class="control" type="text" name="_email" value="'.$usuario->email().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Háblanos sobre ti:</label> <input class="control" type="text" name="_descrip" value="'.$usuario->descrip().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Fecha de nacimiento:</label> <input class="control" type="date" name="_cumple" value="'.$usuario->cumple().'" required />';
			
			$html .='<input class="grupo-control" type="hidden" name="_id" value="'.$usuario->id().'"/>';
			$html .='	<div class="grupo-control"><button type="submit"  name="modificarusu">Modificar</button></div>';
			$html .='</fieldset>';
			return $html;
		}
}

?>

<div id="contenido">
	<h1>Modificar usuario</h1>
<?php
		$formu = new ModifUsu('modificarusu', array('action' => NULL));
		$formu->gestiona();
?>
</div>