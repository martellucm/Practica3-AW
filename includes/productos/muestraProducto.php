 <?php
 $id = $_GET['id'];
    require_once __DIR__.'/GestionProducto.php';
     	$producto = GestionProducto::guardarProducto($id);
        if(is_array($producto)){
          $directorio = 'img/products/'.$id.'.jpg';

          if(@file_get_contents($directorio) == null){
                echo '<div class = "pr"><img src="img/products/default.jpg"/> '; echo '</div>';
          }
          else{
              echo '<div class = "pr"><img src='.$directorio.'>'; echo '</div>';
          }
           echo '<div class = "pro">';            
          echo '<h1>'.$producto['nombre'].'</h1>';
          echo '<h2> ⭐ '.$producto['puntos'].'</h2><h3> 🎂 '.$producto['edad'].'</h3>';
         
          /*echo '<div class = "pr"><h2> Edad: '.$producto['edad'].'</h2></div>';*/
          echo '<h2> 👨‍👨‍👧‍👦:  '.$producto['jugadores'].'</h2><h3>🏭 '.$producto['empresa'].'</h3>';
          echo '<h2>🔗 '.$producto['link'].'</h2>';
          echo '</div>';
          echo '<div class = "pr">';
           echo '<p>'.$producto['descript'].'</p>';
            echo '</div>';

        }
        else{
          echo "<p>No ha encontrado el producto</p>";
        }
?>
