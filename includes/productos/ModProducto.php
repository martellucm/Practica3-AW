 <?php
	require_once __DIR__.'/../comun/config.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__.'/Producto.php';

class ModifProducto extends Form {


	protected function procesaFormulario($datos){
			$id3 = $datos['_id'];
			if (! isset($_POST['modificarprod']) ) {
				header('Location: productos.php?id='.$id3);
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


			if (count($erroresFormulario) === 0) {
				
				Product::actualizaProduct($id3, $nombreProducto, $descrip, $edad, $jugadores, $link, $empresa);
				return 'productos.php?id='.$id3.'';			}

			return $erroresFormulario;
		}

	protected function generaCamposFormulario($datosIniciales){
		 	$id = $_GET['id'];
     		$producto = Product::buscaProduco($id);

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

				
				$datosIniciales['_id'] = $producto->id();
				$datosIniciales['_nombreProducto'] = $producto->nombreProd();
				$datosIniciales['_puntos'] = $producto->puntos();
				$datosIniciales['_descrip'] = $producto->descript();
				$datosIniciales['_edad'] = $producto->edad();
				$datosIniciales['_jugadores']= $producto->jugadores();
				$datosIniciales['_link'] = $producto->link();
				$datosIniciales['_empresa']=$producto->empresa();
			

			$html = '';
			$html .='	<fieldset>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Nombre del producto:</label> <input class="control" type="text" name="_nombreProducto" value="'.$producto->nombreProd() .'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Descripción:</label> <input class="control" type="text" name="_descrip" value="'.$producto->descript().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Edad:</label> <input class="control" type="number" name="_edad" min ="1" max = "99" value="'.$producto->edad().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Jugadores:</label> <input class="control" type="number" name="_jugadores" min = "1" max = "20" value="'.$producto->jugadores().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>link:</label> <input class="control" type="url" name="_link" value="'.$producto->link().'" required />';
			$html .='	</div>';
			$html .='	<div class="grupo-control">';
			$html .='		<label>Empresa:</label> <input class="control" type="text" name="_empresa" value="'.$producto->empresa().'" required />';
			$html .='	</div>';
			$html .='<input class="grupo-control" type="hidden" name="_id" value="'.$producto->id().'"/>';
			$html .='	<div class="grupo-control"><button type="submit"  name="modificarprod">Modificar</button></div>';
			$html .='</fieldset>';
			return $html;
		}
}

?>

<div id="contenido">
	<h1>Modificar producto</h1>
<?php
		$formu = new ModifProducto('modificarprod', array('action' => NULL));
		$formu->gestiona();
?>
</div>