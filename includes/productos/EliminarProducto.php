 <?php
 	require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/Producto.php';
 ?>

 <div>
 <?php   
 	 
     $id = $_GET['id'];
     Product::eliminaProducto($id);
     Header("Location: prodtabla.php");
?>
</div>
