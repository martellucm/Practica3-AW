<div id = "cabecera">
	<a href='index.php'><img src="img/Logo.svg" width="200" height="300"></a>
	<div class="saludo">
		<?php
		if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
			?>
			<p>
			<?php
			echo "Bienvenido, " . $_SESSION['nombre'] . "";
			?>
			</p>
			<a href='../usuarios/miBoqueron.php'>Mi boquerón</a>
			<a href='logout.php'>(salir)</a>
			
		
		<?php

		} else {
			echo "<a href='includes/usuarios/registro.php'>Registro</a>";
			echo "<a href='login.php'>Login</a>";
		}
		?>
	</div>
	<div class="navMenu">
		<ul>
			<li><a href='index.php'>Home</a></li>
			<li><a href='prodtabla.php'>Productos</a></li>
			<li><a href='../estructura/none_page.php'>Torneos</a></li>
			<li><a href='includes/estructura/none_page.php'>About us</a></li>
			<li><a href='includes/estructura/none_page.php'>Foro</a></li>
			<?php
			if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
			?>
			<li><a href='includes/usuarios/userTabla.php'>G.Usuarios</a></li>
			<?php }?>
		</ul>
	</div>
</div>
