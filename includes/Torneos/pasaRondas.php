<?php
require_once __DIR__ .'/../comun/config.php';
$idJug = $_POST['idJug'];
$fecha = $_POST['fecha'];
$idProd = $_POST['idProd'];
$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();
$query = sprintf("SELECT * FROM torneo_jugando t WHERE t.id_jugad_jugan = '%s", $conn->real_escape_string($_POST['idJug']));
$rs = $conn->query($query);
var_dump($rs);
header("../../mostrarClasif.php?id=".$idProd"&fecha=".$fecha);

?>