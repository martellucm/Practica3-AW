 <?php
 	require_once __DIR__.'/includes/comun/config.php';
    require_once __DIR__.'/includes/productos/Producto.php';
 ?>

 <div>
 <?php   
 	 
     $id = $_GET['id'];
     Product::eliminaProducto($id);
     Header("Location: includes/productos/prodtabla.php");
?>
</div>
