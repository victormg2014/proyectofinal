<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
$imagen = isset($_POST['foto']) ? $_POST['foto'] : '';
if ($usuario == null){
	header('Location: index.php');
}
?>
<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");

$tabla = "cuenta";
$hash = password_hash($_POST['clave'], PASSWORD_DEFAULT);

if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$query = "SELECT max(id) as maximo from cuenta";
if ($resultado = $conexion->query($query)) {
	while ($fila = $resultado->fetch_row()) {
		$siguiente = $fila[0] + 1;
	}
   	$resultado->close();
}

// Crea un directorio para insertar las imágenes con el nombre del usuario
if (!file_exists('img/perfiles/' . $usuario)) {
    mkdir('img/perfiles/' . $usuario, 0777, true);
}

// Utiliza el nuevo id para renombrar la imagen que va a subir y la ruta
$imagen = $usuario . '.jpg';
$publicacion = 'img/perfiles/' . $usuario . '/' . $imagen;

$target_path = 'img/perfiles/' . $usuario . "/";
$target_path = $target_path . $imagen;
if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) { 
	echo "El archivo ". basename( $_FILES['foto']['name']). " ha sido subido";
} else{
	echo "Ha ocurrido un error, intentelo de nuevo";
}

/*
$uploadedfileload="true";
$uploadedfile_size=$_FILES['foto'][size];
echo $_FILES[foto][name];
if ($_FILES[foto][size]>200000)
{$msg=$msg."El archivo es mayor que 200KB, debes reducirlo antes de subirlo<BR>";
$uploadedfileload="false";}

if (!($_FILES[foto][type] =="image/pjpeg" OR $_FILES[foto][type] =="image/png"))
{$msg=$msg." Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";}

$file_name=$_FILES[foto][name];
$add="uploads/$file_name";
if($uploadedfileload=="true"){

if(move_uploaded_file ($_FILES[foto][tmp_name], $add)){
echo " Ha sido subido satisfactoriamente";
}else{echo "Error al subir el archivo";}

}else{echo $msg;}
*/



$comprobar = "SELECT * FROM $tabla WHERE usuario = '$_POST[usuario]'";
$result = $conexion->query($comprobar);
$count = mysqli_num_rows($result);

if ($count == 1) {
	echo "<div align='center'/>El nombre de usuario ya est&aacute; en uso.<br/>";
	echo "<a href='registro.php'>Por favor escoga otro nombre</a></div>";
}
else{
	$query = "INSERT INTO cuenta (usuario, nombre, clave, ruta_foto) VALUES ('$usuario', '$nombre' ,'$hash' ,'$target_path')";
	if ($conexion->query($query) === TRUE) {
		header('Location: index.php');
	}
	else {
		echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
	}
}
 mysqli_close($conexion);
?>
</body>
</html>