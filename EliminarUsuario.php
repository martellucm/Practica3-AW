 <?php
 	require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/Usuario.php';
 ?>

 <div>
 <?php   
 	 
     $id = $_GET['id'];
     Usuario:: eliminarUsuario($id);
     Header("Location: userTabla.php");
?>
</div>