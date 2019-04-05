<?php
	/*Aquí se tramitan los datos*/
	$id = isset($_POST['idUsu'])? $_POST['idUsu'] : null;
	$juego = isset($_POST['juego'])? $_POST['juego'] : null;
	$ronda = 'clasificacion';
	$puntos = 0;
?>
<script type="application/javascript">
	function finMes(dia, mes){
		if((dia == 31 && (mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12 )) 
			|| (dia == 28 && mes == 2 )
			|| (dia == 30 && (mes == 4 || mes == 6 || mes == 9 || mes == 11 ))  return true;
		return false;
	}
	var hoy = new Date();
	var ww = hoy.getDay();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();
	var dia = yyyy + '-' + mm + '-' + dd; //dia jugado
	var esViern = false;
	var esMes = false;
	if(ww == 5){
		esViern = true;
	}
	if(finMes(dd, mm)){
		esMes = true;
	}
	// Aquí implementar funcionalidad de php
</script>