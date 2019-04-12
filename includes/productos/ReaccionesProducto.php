
 <?php
  require_once __DIR__ . '/../comun/config.php';
 class Valoracion{
	 public static function setPuntuacion($id){
	 	if (!isset($_SESSION['login'])) {

		  echo '<div class ="valorar">';
          echo "<p>Usuario no registrado!</p>";
          echo "<p>No puedes votar</p>";
        } else {
		echo '<div class ="valorar">';
		echo	 '<h1>VALORA ESTE JUEGO</h1>';
		echo '<div class ="estr">';
		echo '<form id="starRating" action = "includes/productos/ValorarProducto.php?id='.$id.'" method="POST">';
			?>
			<input type="submit" id="star5" name="val" value="5">
			<label for="star5">★</label>
			<input type="submit" id="star4" name="val" value="4">
			<label for="star4">★</label>
			<input type="submit" id="star3" name="val" value="3">
			<label for="star3">★</label>
			<input type="submit" id="star2" name="val" value="2">
			<label for="star2">★</label>
			<input type="submit" id="star1" name="val" value="1">
			<label for="star1">★</label>
			 </form>
		</div>

<?php

		echo	'<h2>Comentarios</h2>';

		if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
           	echo '<div class = "coment"></div>';
           	echo'<div id="prcom">';
             echo '<a id="mod_pr" href="ModificarProducto.php?id='.$id.'"> Modificar producto</a>';
             echo'</div>';
           }
           
		echo' </div>';
		if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
		echo'<div id="chng_pc">';
         	echo '<form action="includes/comun/comotuquieras.php?id='.$id.'&where=products" method="POST" enctype="multipart/form-data">';
			echo '<input type="file" name="file">';
			echo '<button type="submit" name="submit"> Actualizar foto</button>';
			echo' </div>';
			}
		}
	}
	
}
 ?>
