<?php

	require_once __DIR__.'/Inscrito.php';

class GestionaTorneo{

    public static function getTopPlayers($juego, $fecha){
	       $app = Aplicacion::getSingleton();
	       $conn = $app->conexionBd();
	       if ($fecha === "" && $juego === "0"){
          	  $query = sprintf("SELECT * FROM torneo  WHERE Puntuacion > 1 ORDER BY Puntuacion DESC");
	        }
	        else if($fecha !== "" && $juego !== ""){
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
}

?>
