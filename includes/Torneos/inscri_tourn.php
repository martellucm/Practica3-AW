	<div id="inscri_tour">
		<h2>Inscribirse a un torneo</h2>
		<form action="" method="POST">
			<select name="juego">
				<!--Torneos disponibles en bucle for-->
				<option value="id1">Juego1</option>
				<option value="id2">Juego2</option>
				<option value="id3">Juego3</option>
				<option value="id4">Juego4</option>
			</select>
			<input type="hidden" name ="idUsu" value="<?$_SESSION['id']?>">
			<input type="submit" name="Inscribirse"> 
		</form>
	</div>