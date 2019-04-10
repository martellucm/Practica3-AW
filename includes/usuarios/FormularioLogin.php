<?php
	require_once __DIR__.'/../comun/config.php';
	require_once __DIR__.'/Usuario.php';
	require_once __DIR__.'/../comun/Form.php';

	class FormularioLogin extends Form{

		protected function procesaFormulario($datos){

			if (! isset($datos['login']) ) {
				header('Location: login.php');
				exit();
			}

			$formu = array();
			$erroresFormulario = array();

			$nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;

			if ( empty($nombreUsuario) ) {
				$erroresFormulario[] = "El nombre de usuario no puede estar vacío";
			}

			$password = isset($datos['password']) ? $datos['password'] : null;
			if ( empty($password) ) {
				$erroresFormulario[] = "El password no puede estar vacío.";
			}

			if (count($erroresFormulario) === 0) {
				$usuario = Usuario::buscaUsuario($nombreUsuario);
				if (!$usuario) {
					$erroresFormulario[] = "El usuario o el password no coinciden";
				} else {
					if($usuario->compruebaPassword($password)){
					//if(false){
						$_SESSION['login'] = true;
						$_SESSION['nombre'] = $nombreUsuario;
						$_SESSION['esAdmin'] = $usuario->rol() === 'admin' ? true : false;
						return 'index.php';

					}
					else{
						$erroresFormulario[] = "El usuario o el password no coinciden";
					}
				}
			}

			return $erroresFormulario;

		}


		 protected function generaCamposFormulario($datosIniciales)
		{
			$nombrUsu = '';
			$passw = '';

			/*
			* En caso de que hubiera un error se mantienen
			* los datos para que puedas modificarlos
			*/

			if(isset($datosIniciales['login'])){
				$nombrUsu = $datosIniciales['nombreUsuario'];
				$passw = $datosIniciales['password']; // Opcional
			}
			$html = ''; // String que genera el html
			$html .= '<fieldset class = "formulario">';
            $html .= '<legend>Login</legend>';
            $html .= '	<div class="grupo-control">';
            $html .= '   <label>  👤  </label> <input type="text" name="nombreUsuario" value="'.$nombrUsu.'"required/>';
            $html .= '  </div>';
            $html .= '  <div class="grupo-control">';
            $html .= '   <label>🔒</label> <input type="password" name="password" value="'.$passw.'"required/>';
            $html .= '  </div>';
            $html .= '  <div class="grupo-control"><button type="submit" name="login">Entrar</button></div>';
			$html .= '</fieldset>';
			return $html;
		}

	}

?>

<div id="contenido">
<?php
		$formu = new FormularioLogin('login', array('action' => NULL));
		$formu->gestiona();
?>
</div>
