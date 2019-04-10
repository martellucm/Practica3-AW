<?php
require_once __DIR__ .'/../comun/config.php';
$idJug = $_POST['idJug'];
$fecha = $_POST['fecha'];
$idProd = $_POST['idProd'];
$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();
$query = sprintf("SELECT * FROM `torneo_jugando` WHERE `id_jugad_jugan` = '%s'", $conn->real_escape_string($idJug));
$rs = $conn->query($query);
if ($rs) {
	var_dump(mysqli_fetch_assoc($rs));
 }
 header("../../mostrarClasif.php?id=".$idProd."&fecha=".$fecha);

?>