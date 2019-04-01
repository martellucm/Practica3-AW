
<?= 
	require_once __DIR__.'/GestionProducto.php';
	require_once __DIR__.'/config.php';
?>
<div>
	<?php 
	     $id = $_GET['id']; 
	     $val = $_POST['val'];
	     GestionProducto::actualizaPuntuacion($val, $id);
	     Header("Location: ../productos.php?id=$id");
	?>
</div>



