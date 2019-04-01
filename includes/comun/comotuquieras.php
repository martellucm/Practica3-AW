<?php

	$dir_subida = 'img/' . $_GET['where'] . '/';
	$new_name = $_GET['id'];
	
	if(isset($_POST['submit'])){
		$file = $_FILES['file'];
		
		$fileName = $new_name;
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$fileExt = explode('.', $_FILES['file']['name']);
		$fileActualExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'png', 'jpeg');
		
		if(in_array($fileActualExt,$allowed)){
			if($fileError === 0){
				if($fileSize <= 500000){
					unlink('img/' . $_GET['where'] . '/' . $_GET['id'] . '.png');
					unlink('img/' . $_GET['where'] . '/' . $_GET['id'] . '.jpg');
					unlink('img/' . $_GET['where'] . '/' . $_GET['id'] . '.jpeg');
					$fileDestination = $dir_subida . $fileName. "." .$fileActualExt;
					//$fileDestination = 'img/users/2.jpg';
					move_uploaded_file($fileTmpName, $fileDestination);
					if ($_GET['where'] == "users"){
						header("Location: includes/usuarios/miBoqueron.php");
					}else{
						header("Location: includes/productos/productos.php?id=".$new_name);
					}
				}
				else{
					echo 'La foto es demasiado grande.';
				}
			}
			else{
				echo 'Hubo un error subiendo la foto.';
			}
		}
		else{
			echo 'Sube un fichero con extensión .jpg, .png ó .jpeg';
		}
	}


?>