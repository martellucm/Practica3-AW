<?php
class GestionaTorneo{

    public static function getTopPlayers(){
	       $app = Aplicacion::getSingleton();
	       $conn = $app->conexionBd();
	       $query = sprintf("SELECT idUsuario, Puntuacion, idJuego FROM torneo  WHERE Puntuacion > 1 ORDER BY Puntuacion DESC");
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

      
}

?>