<?php

	require_once __DIR__.'/Inscrito.php';
	require_once __DIR__.'/../productos/Producto.php';

class GestionaTorneo{
	  public static function filtarPorDefecto(){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM producto");
        $rs = $conn->query($query);

        while($row = mysqli_fetch_assoc($rs)){
          $rows[] = $row;
        }

        for($i = 0; $i < count($rows); $i++){
          echo "<option value=".$rows[$i]["id"].">".$rows[$i]["nombreProd"]."</option>";
        }
    }

    public static function getTopPlayers($juego, $fecha){
	       $app = Aplicacion::getSingleton();
	       $conn = $app->conexionBd();
			if (($fecha === "" && $juego ==="-1") || (is_null($fecha) && is_null($juego))){
          	  $query = sprintf("SELECT * FROM torneo  WHERE Puntuacion > 1 ORDER BY Puntuacion DESC");
	        }
	        else if ($fecha !== "" && $juego !== "-1"){
	          $query = sprintf("SELECT * FROM torneo  WHERE Puntuacion > 1 and dia_ganado = '%s' AND idJuego = '%s' ORDER BY Puntuacion DESC", $conn->real_escape_string($fecha), $conn->real_escape_string($juego));
	        }
	        else if($fecha !== ""){
	          $query = sprintf("SELECT * FROM torneo  WHERE Puntuacion > 1 and dia_ganado = '%s' ORDER BY `Puntuacion`DESC", $conn->real_escape_string($fecha));
	        }
	        else if($juego !== ""){
	          $query = sprintf("SELECT * FROM torneo  WHERE Puntuacion > 1 and idJuego = '%s' ORDER BY `Puntuacion`DESC", $conn->real_escape_string($juego));
	        }


	       $rs = $conn->query($query);
	       $result = false;
	       if ($rs) {
	        if ($rs->num_rows > 0) {
	          while( $fila = mysqli_fetch_assoc($rs)) {
	          	$players[] = $fila ;
	          }
	        $result = $players;
	        $rs->free();
        }
       } else {
           echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
           exit();
       }
       return $result;
    } //Obtiene los id puntos e idJuego del torneo cuya puntuacion es mayor de 1

    public static function getTorneos(){
		$aux = Inscrito::generaRandom();
		$i = 0;
		$result[] = $aux;
		if(!empty($aux)){
			while($i <1){ // Tamaño de torneos a expotar
						if(!in_array($aux, $result)){
							$result[] = $aux;
							$i++;
						}
						$aux = Inscrito::generaRandom();
					}
		}

		return $result;
	}

	public static function setGanador($datos){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		$query=sprintf("INSERT INTO torneo(idUsuario, tipoTorneo, idJuego, Puntuacion, dia_ganado, esMensual, esViernes)
						VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s')"
			, $conn->real_escape_string($datos['idUsuario'])
			, $conn->real_escape_string($datos['tipoTorneo'])
			, $conn->real_escape_string($datos['idJuego'])
			, $conn->real_escape_string($datos['Puntuacion'])
			, $conn->real_escape_string($datos['dia_ganado'])
			, $conn->real_escape_string($datos['esMensual'])
			, $conn->real_escape_string($datos['esViernes']));
		if ( $conn->query($query) ) {
			$query =sprintf("DELETE FROM `torneo_jugando` WHERE `idJuego` = '%s' AND `dia_jugado` = '%s'"
					, $conn->real_escape_string($datos['idJuego'])
					, $conn->real_escape_string($datos['dia_ganado']));
			if($conn->query($query)){
				header('Location: ../index.php');
			}else{
				echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
				exit();
			}
		} else {
			echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
			exit();
		}

		return $jug;
	}
}

?>
