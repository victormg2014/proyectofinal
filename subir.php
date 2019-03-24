<?php
session_start();
include("connect.php");

// Obtiene el mayor id actual y lo incrementa en uno en la variable $siguiente
$query = "SELECT max(id) as maximo from publicaciones";
if ($resultado = $conexion->query($query)) {
	while ($fila = $resultado->fetch_row()) {
		$siguiente = $fila[0] + 1;
	}
   	$resultado->close();
}

$usuario = $_SESSION['username'];
$contenido = $_POST['contenido'];
$formato = $_POST['formato'];

// Crea un directorio para insertar las imágenes con el nombre del usuario
if (!file_exists($_SESSION['username'])) {
    mkdir($_SESSION['username'], 0777, true);
}

// Utiliza el nuevo id para renombrar la imagen que va a subir y la ruta

if ($formato == 'video') {
	$nombre = $siguiente . '.mp4';
} elseif ($formato == 'imagen'){
	$nombre = $siguiente . '.jpg';
} elseif ($formato == 'audio'){
	$nombre = $siguiente . '.mp3';
}

$publicacion = $usuario . '/' . $nombre;

$target_path = $usuario . "/";
$target_path = $target_path . $nombre;
if(move_uploaded_file($_FILES['subir']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['subir']['name']). " ha sido subido";
} else{
echo "Ha ocurrido un error, intentelo de nuevo";
}

$query = "INSERT INTO publicaciones (usuario, ruta, contenido, formato) VALUES ('$usuario', '$publicacion', '$contenido', '$formato')";
if ($conexion->query($query) === TRUE) {
	header('Location: perfil.php');
}
else {
	echo "Error al a&ntilde;adir a la BD." . $query . "<br>" . $conexion->error; 
}

 mysqli_close($conexion);
?>
<form method="post" action="perfil.php">
	<input type="submit" value="Volver">
</form>