<?php
    require_once __DIR__.'/Usuario.php';
    class GestionUsuario{
          public static function mostrarWW(){
        $user = Usuario::getWW();
        if($user instanceof Usuario){
          $id = $user->id();
            $directorio = "img/users/$id.jpg";
            if(file_get_contents($directorio) == null){
                    echo '<div id="img_userh"><img src="img/users/default_user.png"/></div> ';
                }
                else{
                    echo '<div id = "img_userh"><img src='.$directorio.'></div>';
                }
          echo "<div id=\"user_data\"><p>Usuario: ".$user->nombreUsuario()."</p>";
          echo "<p> Puntos: ".$user->ptosTourn()."</p> </div>";
        }
        else{
            echo "<p>No hay un ganador claro</p>";
        }
      }

      public static function mostrarWM(){
        /*Hay que modificarlo por el de month*/
        $user = Usuario::getWW();
        if($user instanceof Usuario){
          echo '<div><img src="data:image/jpg; base64,'.base64_encode($user->fprincipal()).'" />';
          echo "<div><p>".$user->nombreUsuario()."</p>";
          echo "<p>".$user->ptosTourn()."</p> </div>";
        }
        else{
            echo "<p>No hay un ganador claro</p>";
        }
      }

      public static function mostrarUsuarioCorto($row){
		$id = $row->id();
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
        echo '<div class ="name_product"> <p>'.$row->nombreUsuario().'</p></div>';
       
         echo  '<div class ="p_product">';
           echo '<form action = "ModUsuAdmin.php?id='.$id.'"method="POST"> <input type="submit" value="Modificar">
              </form>';
            echo '</div>';
          echo  '<div class ="p_producte">';
             echo '<form action = "EliminarUsuario.php?id='.$id.'"method="POST"> <input type="submit" value="Eliminar">
              </form>';
            echo '</div></div>';
       

        }//Muestra la forma corta de un producto
       public static function listadoUsuario(){
        $user = GestionUsuario::getUsers();
          if(is_array($user)){
            foreach ($user as &$row) {
        if($row->rol() != 'admin'){
        GestionUsuario::mostrarUsuarioCorto($row);
        }
          }
        }
      }//Sirve para la parte de producto y muestra todos los productos



		public static function getUsers(){
          $app = Aplicacion::getSingleton();
           $conn = $app->conexionBd();
           $query = sprintf("SELECT `id` FROM `usuarios`");
           $rs = $conn->query($query);
           $result = false;
           if ($rs) {
            if ($rs->num_rows > 0) {
              while( $row = mysqli_fetch_assoc($rs)) {
               $user[] = Usuario::buscaUsuarioID($row['id']);
              }
              $result = $user;
              $rs->free();
            }
           } else {
               echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
               exit();
           }
           return $result;
        }//Obtiene todos los productos
    }
?>
