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

// Crea un directorio para insertar las imágenes con el nombre del usuario
if (!file_exists($_SESSION['username'])) {
    mkdir($_SESSION['username'], 0777, true);
}

// Utiliza el nuevo id para renombrar la imagen que va a subir y la ruta
$nombre = $siguiente . '.jpg';
$publicacion = $usuario . '/' . $nombre;

$target_path = $usuario . "/";
$target_path = $target_path . $nombre;
if(move_uploaded_file($_FILES['subir']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['subir']['name']). " ha sido subido";
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}

$query = "INSERT INTO publicaciones (usuario, ruta) VALUES ('$usuario', '$publicacion')";
if ($conexion->query($query) === TRUE) {
	echo "<div align='center'/><h2>Se ha a&ntilde;adido correctamente a la BD</h2><br/>";
}
else {
	echo "Error al a&ntilde;adir a la BD." . $query . "<br>" . $conexion->error; 
}

 mysqli_close($conexion);
?>
<form method="post" action="perfil.php">
	<input type="submit" value="Volver">
</form>