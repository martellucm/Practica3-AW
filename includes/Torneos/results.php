<?php
	 require_once __DIR__ .'/../comun/config.php';
     require_once __DIR__.'/../productos/Producto.php';
     require_once __DIR__.'/../usuarios/Usuario.php';
     require_once __DIR__.'/../usuarios/GestionaUsuario.php';
     require_once __DIR__.'/../productos/GestionProducto.php';
     require_once __DIR__.'/GestionaTorneo.php';

  class MostrarResults{


    public static function filtarPorDefecto(){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM producto");
        $rs = $conn->query($query);
      
        while($row = mysqli_fetch_assoc($rs)){
          $rows[] = $row;
        }
      
        for($i = 0; $i < count($rows); $i++){
          echo "<option value=".$rows[$i]["id"].">".$rows[$i]["nombreProd"]."</option>";
        } 
    }

   public static function getPodiumPlayers($juego, $fecha){
         $app = Aplicacion::getSingleton();
         $conn = $app->conexionBd();
        if ($fecha === "" && $juego === "0"){
          $query = sprintf("SELECT `id` FROM `usuarios` ORDER BY `ptosTourn`DESC LIMIT 3");
        }
        else if($fecha !== ""){
          $query = sprintf("SELECT `idUsuario` as id FROM torneo WHERE dia_ganado = '%s' ORDER BY `Puntuacion`DESC LIMIT 3", $conn->real_escape_string($fecha));
        }
        else if($juego !== ""){
          $query = sprintf("SELECT `idUsuario` as id FROM torneo WHERE idJuego = '%s' ORDER BY `Puntuacion`DESC LIMIT 3", $conn->real_escape_string($juego));
        }
         else {
          $query = sprintf("SELECT `idUsuario` as id FROM `torneo` WHERE dia_ganado = '%s' AND idJuego = '%s' ORDER BY `Puntuacion`DESC LIMIT 3", $conn->real_escape_string($fecha), $conn->real_escape_string($juego));
        }
         $rs = $conn->query($query);
         $result = false;
         if ($rs) {
          if ($rs->num_rows > 0) {
            while( $fila = mysqli_fetch_assoc($rs)) {
              $players[] =  $fila['id'];
            }
          $result = $players;
          $rs->free();
        }
       } else {
           echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
           exit();
       }
       return $result;
    } //Obtiene los id y puntos de los jugadores des

    public static function mostrarPodium($row){
		$id = $row;
    	$user = Usuario::buscaUsuarioID($id);
    	$directorio = "img/users/$id.jpg";
		$directorioPNG = "img/users/$id.png";
		$directorioJPEG = "img/users/$id.jpeg";
        if(@file_get_contents($directorio) == null){
            if(@file_get_contents($directorioPNG) == null){
                if(@file_get_contents($directorioJPEG) == null){
                    echo '<div class ="products"><div class="img_user"><img src="img/users/default_user.png"></div> ';
                }else{
                    echo '<div class ="products"><div class="img_user"><img src='.$directorioJPEG.'></div>';
                }
            }
            else{
                echo '<div class ="products"><div class="img_user"><img src='.$directorioPNG.'></div>';
            }
        }
        else{
            echo '<div class ="products"><div class="img_user"><img src='.$directorio.'></div>';
        }
         echo '<div class ="name_winners"> <p>'.$user->nombreUsuario().'</p></div>';
       
         echo  '<div class ="points_winner"><p>'.$user->ptosTourn().'</p></div>';  
         echo '</div>';
    }

    public static function getResults($n){    
        $juego = $_POST['filtroJ'];
        $fecha = $_POST['filtroF'];	
    	  if ($n !== 3){
    	  	$ganador = GestionaTorneo::getTopPlayers($juego, $fecha);
         		 echo '<table class ="name_table">';
        		 echo '<tr> 
         			<th>Nombre</th>
   					<th>Torneo Ganado</th>
            <th>Fecha</th>
   					</tr>';
         }
         else{
         	$ganador = self::getPodiumPlayers($juego, $fecha);
         }
         $i = 0;
         if(is_array($ganador)){
          foreach ($ganador as &$row) {
          	if ($n === 3){
            	self::mostrarPodium($row);
        	}
        	else{
        	   	self::mostrarTabla($row);
        	}
            $i++;
            if ($i >= $n){
              break;
            }
          }
          if ($n !== 3){
          	echo '</table>';
          }
           unset($row);
         }
    }// Ponerle 3 en n para que saque a los mejores y otro para la tabla

     public static function mostrarTabla($row){
    	$id = $row['idUsuario'];
    	$idJuego = $row['idJuego'];
    	$user = Usuario::buscaUsuarioID($id);
    	$prod = Product::buscaProduco($idJuego);

   		 echo '<tr> 
         		<th>'.$user->nombreUsuario().'</th>
   				<th>'.$prod->nombreProd().'</th>
          <th>'.$row['dia_ganado'].'</th>
   				</tr>';

         //echo '</table>';
    }
    
}
?>
