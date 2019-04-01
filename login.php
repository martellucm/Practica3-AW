<?php
require_once __DIR__.'/includes/comun/config.php';
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
</head>

<body>

	<div id="contenedor">

		<?php
			require("includes/comun/cabecera.php");
			require("includes/usuarios/FormularioLogin.php");
		?>
	</div>

</body>
</html>