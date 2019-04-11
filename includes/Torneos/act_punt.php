<?php
	require_once __DIR__. '/../comun/config.php';
	require_once __DIR__.'/GestionaTorneo.php';
	require_once __DIR__.'/../comun/Form.php';
	require_once __DIR__. '/Inscrito.php';
	require_once __DIR__. '/torneo.php';
	require_once __DIR__. '/../usuarios/Usuario.php';

	class FormularioActualiza extends Form{

		protected function procesaFormulario($datos){
			return $datos;
		}

		 protected function generaCamposFormulario($datosIniciales)
		{

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/
			$nom = $_SESSION['nombre'];
			$id = Usuario::buscaUsuario($nom);
			$arr = Torneo::getTorneoID($id->id());
			$html = ''; // String que genera el html
			$html .= '<fieldset>';
            $html .= '<legend>Actualiza puntos</legend>';
            $html .= '	<div class="grupo-control">';

				 if(!empty($arr)){
					$html .= '<select name="idProd">';
					foreach($arr as $row){
						$html .= '<option value="'.$row['juego'].'">'.$row['juego'].'</option>';
					}
					$html .= '</select>';
				 }
				 else{
					$html .= '<p>ERROR</p>';
				 }
			$html .= '<input type="hidden" name="idJug" value="'.$id->id().'">';
			$html .= '<input type="hidden" name="fecha" value="'.$row['fecha'].'">';
            $html .= '  <div class="grupo-control"><button type="submit" name="actualiza">Actualiza</button></div>';
			$html .= '</fieldset>';
			return $html;
		}


	}
?>

<div id="actu_puntos">
			<h2>Actualiza puntuación</h2>
		<?php
			$formu = new FormularioActualiza('actualiza', array('action' => 'includes/Torneos/pasaRondas.php'));
			$formu->gestiona();
		?>
	</div>
