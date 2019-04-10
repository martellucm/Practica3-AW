
<header>

<div class="wrapp">
	<div class="logo">
			<a href='index.php'><img src="img/Logo.svg"></a>
	</div>


	<nav>

			<a href='index.php'>Home</a>
			<a href='prodtabla.php'>Productos</a>
			<a href='torneo.php'>Torneos</a>
			<a href='none_page.php'>About us</a>
			<a href='none_page.php'>Foro</a>
			
			<?php
			if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
			?>
			<a href='userTabla.php'>G.Usuarios</a>
			<?php }?>
		</nav>

		<nav class="b">

		<?php
		if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
			?>
			<a class = "b" href='logout.php'>(salir)</a>
			<a class = "b" href='miBoqueron.php'>Mi boquerón</a>
			
			
		
		<?php

		} else {
			 ?>
			<a class = "b" href='registro.php'>Registro</a>
			<a class= "b" href='login.php'>Login </a>
			<?php
		}
		?>
	</nav>
		</div>
	</header>

