
<?= 
	require_once __DIR__.'/productos/GestionProducto.php';
	require_once __DIR__.'/comun/config.php';
?>
<div>
	<?php 
	     $id = $_GET['id']; 
	     $val = $_POST['val'];
	     GestionProducto::actualizaPuntuacion($val, $id);
	     Header("Location: productos/productos.php?id=$id");
	?>
</div>



