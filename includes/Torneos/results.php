<?php
	 require_once __DIR__ .'/../comun/config.php';
     require_once __DIR__.'/../productos/Producto.php';
     require_once __DIR__.'/../usuarios/Usuario.php';
     require_once __DIR__.'/../usuarios/GestionaUsuario.php';
     require_once __DIR__.'/../productos/GestionProducto.php';
     require_once __DIR__.'/GestionaTorneo.php';


static class MostrarResults{

   public static function getPodiumPlayers(){
         $app = Aplicacion::getSingleton();
         $conn = $app->conexionBd();
         $query = sprintf("SELECT `id` FROM `usuarios`ORDER BY `ptosTourn`DESC LIMIT 3");
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
    	
    	  if ($n !== 3){
    	  	$ganador = GestionaTorneo::getTopPlayers();
         		 echo '<table class ="name_table">';
        		 echo '<tr> 
         			<th>Nombre</th>
   					<th>Torneo Ganado</th>
   					</tr>';
         }
         else{
         	$ganador = GestionaTorneo::getPodiumPlayers();
         }
         $i = 0;
         if(is_array($ganador)){
          foreach ($ganador as &$row) {
          	if ($n === 3){
            	MostrarResults::mostrarPodium($row);
        	}
        	else{
        	   	MostrarResults::mostrarTabla($row);
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
   				</tr>';

         //echo '</table>';
    }
    
}
?>