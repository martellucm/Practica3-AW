 <?php
 	require_once __DIR__.'/../comun/config.php';
    require_once __DIR__.'/Producto.php';
 ?>

 <div>
 <?php   
 	 
     $id = $_GET['id'];
     Product::eliminaProducto($id);
     Header("Location: ../../prodtabla.php");
?>
</div>
