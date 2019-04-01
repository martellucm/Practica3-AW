
 <?php
  require_once __DIR__ . '/../comun/config.php';
 class Valoracion{
	 public static function setPuntuacion($id){
	 	if (!isset($_SESSION['login'])) {
          echo "<p>Usuario no registrado!</p>";
          echo "<p>No puedes votar</p>";
        } else {
		echo '<div>';
		echo	 '<p>VALORA ESTE JUEGO <br> (0 - 10) </p>';

		echo	 '<form action = "includes/productos/ValorarProducto.php?id='.$id.'" method="POST">
			 <input type="number" name="val" value="0" min="0" max="10"><br>
			 <input type="submit" value="Valorar">
			 </form>';

		echo	'<p>Comentarios</p>';

		if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
           	echo '<div id = "admin">';
             echo '<a href="includes/productos/ModificarProducto.php?id='.$id.'"> Modificar </a>';
         	echo '<form action="includes/comun/comotuquieras.php?id='.$id.'&where=products" method="POST" enctype="multipart/form-data">';
			echo '<input type="file" name="file">';
			echo '<button type="submit" name="submit"> Actualizar foto</button>';
			echo'</div>';
			;
           }
           
		echo' </div>';
		}
	}
	
}
 ?>
