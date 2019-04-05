<?php
    require_once __DIR__.'/Producto.php';
class GestionProducto{

        public static function guardarProducto($id){
            $producto = Product::buscaProduco($id);

            if(!$producto){
                $arr = "Este producto no existe";
            }
             else{
              $nombre = $producto->nombreProd();
              $puntos = $producto->puntos();
              $descript = $producto->descript();
              $edad = $producto->edad();
              $jugadores = $producto->jugadores();
              $link = $producto->link();
              $empresa = $producto->empresa();
              $num_votaciones = $producto->num_votaciones();
              $id = $producto->id();

              $arr = array(
                "id" => $id,
                "nombre" => $nombre,
                "puntos" => $puntos,
                "descript" => $descript,
                "edad" => $edad,
                "jugadores" => $jugadores,
                "link" => $link,
                "empresa" => $empresa,
                "num_votaciones" => $num_votaciones,
              );
            }

            return $arr;
        }//Guarda un producto en un array

        public static function getMaxProd(){
           $app = Aplicacion::getSingleton();
           $conn = $app->conexionBd();
           $query = sprintf("SELECT id FROM producto WHERE puntos > 6 ORDER BY puntos DESC LIMIT 3");
           $rs = $conn->query($query);
           $result = false;
           if ($rs) {
            if ($rs->num_rows > 0) {
              while( $row = mysqli_fetch_assoc($rs)) {
               $producto[] = GestionProducto::guardarProducto($row['id']);
              }
              $result = $producto;
              $rs->free();
            }
           } else {
               echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
               exit();
           }
           return $result;
        } //Obtiene los productos de puntuacion >6

        public static function mostrarProductoCorto($row){
          $directorio = 'img/products/'.$row['id'].'.jpg';

          if(@file_get_contents($directorio) == null){
              echo '<div class ="products"><a href="productos.php?id='.$row['id'].'"<div id = "img_total"><img src="img/products/default.jpg"/></a>';
          }
          else{
              echo '<div class ="products"><a href="productos.php?id='.$row['id'].'"<div id = "img_total"><img src='.$directorio.'></a>';
          }    

         
         echo '<div class ="name_product"> <p>'.$row['nombre'].'</p></div>';
         echo '<div class ="p_product"> <p> Puntuación:'.$row['puntos'].'</p> </div>';
         ?>
           <div class ="eliminar_prod">
           <?php
           if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
             echo   '<form action = "includes/productos/EliminarProducto.php?id='.$row['id'].'"method="POST"> <input type="submit" value="Eliminar">
              </form>';
           }
           ?>
           </div></div>
           <?php

       }//Muestra la forma corta de un producto

        public static function listadoProductos(){
          $producto = GestionProducto::getProducts();
            if(is_array($producto)){
              foreach ($producto as &$row) {
               GestionProducto::mostrarProductoCorto($row);
            }
          }
        }//Sirve para la parte de producto y muestra todos los productos

        public static function getProducts(){
          $app = Aplicacion::getSingleton();
           $conn = $app->conexionBd();
           $query = sprintf("SELECT `id` FROM `producto`");
           $rs = $conn->query($query);
           $result = false;
           if ($rs) {
            if ($rs->num_rows > 0) {
              while( $row = mysqli_fetch_assoc($rs)) {
               $producto[] = GestionProducto::guardarProducto($row['id']);
              }
              $result = $producto;
              $rs->free();
            }
           } else {
               echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
               exit();
           }
           return $result;
        }//Obtiene todos los productos

        public static function mejoresProductos($n){
        $producto = GestionProducto::getMaxProd();
         $i = 0;
         if(is_array($producto)){
          foreach ($producto as &$row) {
            GestionProducto::mostrarProductoCorto($row);
            $i++;
            if ($i >= $n){
              break;
            }
          }
           unset($row);
         }
        }//Muestra los tres mejores productos



        public static function actualizaPuntuacion($val, $id){
          $producto = null;
          $producto = GestionProducto::guardarProducto($id);
          $producto['puntos'] = (($producto['puntos'] * $producto['num_votaciones']) + $val)/($producto['num_votaciones']+1);
          $producto['num_votaciones']= $producto['num_votaciones']+1;

          $prod = Product::actualizapuntos($producto);
          
        }//Sirve para valorar el juego
    }
 ?>
