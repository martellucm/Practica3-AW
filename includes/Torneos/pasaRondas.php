<?php
require_once __DIR__ .'/../comun/config.php';
$idJug = $_POST['idJug'];
$fecha = $_POST['fecha'];
$idProd = $_POST['idProd'];
$clasificacion = 'clasificacion';
$semis = 'semis';
$final = 'final';
$nextRound= 'final';
$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();

//Primero tendremos que mirar que el usaurio esté clasificado en el torneo
$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s'"
			, $conn->real_escape_string($idJug));
$rs = $conn->query($query);
if($rs->fetch_array() != NULL){

	//Miramos que no esté ya en la final
	$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s' AND `idJuego` = '%s' AND `dia_jugado` = '%s'"
				, $conn->real_escape_string($idJug)
				, $conn->real_escape_string($final)
				, $conn->real_escape_string($idProd)
				, $conn->real_escape_string($fecha));
	$rs = $conn->query($query);
	if (mysqli_fetch_assoc($rs) == NULL){
		//Ahora veremos si está en la semifinal o no
		$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s'  AND `idJuego` = '%s' AND `dia_jugado` = '%s'"
				, $conn->real_escape_string($idJug)
				, $conn->real_escape_string($semis)
				, $conn->real_escape_string($idProd)
				, $conn->real_escape_string($fecha));
		$rs = $conn->query($query);
		//Si no está quiere decir que está en la ronda de clasificación, por lo que
		//tendremos que llevarle a la semifinal.
		if (mysqli_fetch_assoc($rs) == NULL) {
			$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s' AND `idJuego` = '%s' AND `dia_jugado` = '%s'"
					, $conn->real_escape_string($idJug)
					, $conn->real_escape_string($clasificacion)
					, $conn->real_escape_string($idProd)
					, $conn->real_escape_string($fecha));
			$rs = $conn->query($query);
			$nextRound = 'semis';
		}
		$rs->free();

		$result = 2;

		$query=sprintf("UPDATE `torneo_jugando` SET puntos = '%s', ronda='%s' WHERE id_jugad_jugan= '%s' AND idJuego = '%s' AND dia_jugado = '%s'"
				, $conn->real_escape_string($result)
				, $conn->real_escape_string($nextRound)
				, $conn->real_escape_string($idJug)
				, $conn->real_escape_string($idProd)
				, $conn->real_escape_string($fecha)
			);

		$rs = $conn->query($query);
	}


}
header('Location: ../../mostrarClasif.php?id='.$idProd.'&fecha='.$fecha);

?>
