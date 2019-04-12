<?php
	require_once __DIR__. '/../comun/config.php';
	require_once __DIR__.'/GestionaTorneo.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__. '/Inscrito.php';
	require_once __DIR__. '/torneo.php';
	require_once __DIR__. '/../usuarios/Usuario.php';
	require_once __DIR__. '/../productos/Producto.php';

	class FormularioInscrip extends Form{

		protected function procesaFormulario($datos){

			if (! isset($datos['juego']) ) {
				header('Location: torneo.php');
				exit();
			}

			$formu = array();
			$erroresFormulario = array();

			$date = getdate();
			 $hoy = $date['year'];
			 $hoy .= '-';
			 $hoy .= $date['mon'];
			 $hoy .= '-';
			 $hoy .= $date['mday'];
			$idJuego= $datos['juego'];
			$nom =$_SESSION['nombre'];
			$id = Usuario::buscaUsuario($nom);
			$viernes = $date['wday'] == 5? 1: 0;

			if ( $id != true ) {
				$erroresFormulario[] = "El juego tiene que existir";
			}

			if (count($erroresFormulario) === 0) {
				$resul = Inscrito::inscribe($id->id(), $idJuego, $viernes, 0, $hoy);
				if($resul instanceof Inscrito){
					return 'index.php';
				}else{
					$erroresFormulario[] = "El usuario ya está inscrito";
				}
			}

			return $erroresFormulario;

		}

		 protected function generaCamposFormulario($datosIniciales)
		{

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

			$arr = GestionaTorneo::getTorneos();
			$html = ''; // String que genera el html
			$html .= '<fieldset>';
            $html .= '<legend>Inscribirse</legend>';
            $html .= '	<div class="grupo-control">';

				 if(!empty($arr)){
					$html .= '<select name="juego">';
					foreach($arr as $row){
						$val = Torneo::buscarTorneoIdJuego($row['id']);
						$jug = Product::buscaProduco($row['juego']);
						$html .= '<option value="'.$val.'">'.$jug->nombreProd().' - '.$row['fecha'].'</option>';
					}
					$html .= '</select>';
				 }
				 else{
					$html .= '<p>ERROR</p>';
				 }
            $html .= '  <div class="grupo-control"><button type="submit" name="login">Inscribirse</button></div>';
			$html .= '</fieldset>';
			return $html;
		}


	}
?>

	<div id="inscri_tour">
		<h2>Inscribirse a un torneo</h2>

		<?php
			$formu = new FormularioInscrip('inscri', array('action' => NULL));
			$formu->gestiona();
		?>
	</div>
