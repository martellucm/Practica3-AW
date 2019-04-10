<?php
require_once __DIR__ .'/../comun/config.php';
$idJug = $_POST['idJug'];
$fecha = $_POST['fecha'];
$idProd = $_POST['idProd'];
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
	$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s'"
				, $conn->real_escape_string($idJug), $conn->real_escape_string($final));
	$rs = $conn->query($query);
	if (mysqli_fetch_assoc($rs) == NULL){
		//Ahora veremos si está en la semifinal o no
		$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s'"
				, $conn->real_escape_string($idJug), $conn->real_escape_string($semis));
		$rs = $conn->query($query);
		//Si no está quiere decir que está en la ronda de clasificación, por lo que 
		//tendremos que llevarle a la semifinal.
		if (mysqli_fetch_assoc($rs) == NULL) {
			$clasificacion = 'clasificacion';
			$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s' AND `ronda` = '%s'"
					, $conn->real_escape_string($idJug), $conn->real_escape_string($clasificacion));
			$rs = $conn->query($query);
			$nextRound = 'semis';
		}
		
		$result = $rs->fetch_assoc();

		$query = sprintf("SELECT * FROM `torneo_jugando` ORDER BY id DESC");
		$rs2 = $conn->query($query);
		$rs2 = $rs2->fetch_assoc();
		$newID = $rs2['id'];
	 
		$query=sprintf("INSERT INTO `torneo_jugando`(id, jugadores_total, id_jugad_jugan, idJuego, esViernes, esMensual, dia_jugado, puntos, ronda)
							VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
				, $conn->real_escape_string($newID + 1)
				, $conn->real_escape_string($result['jugadores_total'])
				, $conn->real_escape_string($idJug)
				, $conn->real_escape_string($idProd)
				, $conn->real_escape_string($result['esViernes'])
				, $conn->real_escape_string($result['esMensual'])
				, $conn->real_escape_string($fecha)
				, $conn->real_escape_string($result['puntos'])
				, $conn->real_escape_string($nextRound));

		$rs = $conn->query($query);
	}
}
header('Location: ../../mostrarClasif.php?id='.$idProd.'&fecha='.$fecha);

?>