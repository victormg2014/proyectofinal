<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<?php
session_start();
$usuario = $_SESSION['username'];
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$imagen = isset($_POST['foto']) ? $_POST['foto'] : '';
echo $imagen;
?>
<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
// Crea un directorio para insertar las imágenes con el nombre del usuario
if (!file_exists('img/perfiles/' . $usuario)) {
    mkdir('img/perfiles/' . $usuario, 0777, true);
}

$imagen = $usuario . '.jpg';
$publicacion = 'img/perfiles/' . $usuario . '/' . $imagen;

$target_path = 'img/perfiles/' . $usuario . "/";
$target_path = $target_path . $imagen;

$uploadedfileload="true";

echo $_FILES[foto][name];

if (!($_FILES[foto][type] =="image/jpeg" OR $_FILES[foto][type] =="image/png" OR $_FILES[foto][type] =="image/jpg"))
{$msg=$msg." Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";}

$file_name=$_FILES[foto][name];

if($uploadedfileload=="true"){
	if(move_uploaded_file ($_FILES[foto][tmp_name], $target_path)){
	echo " Ha sido subido satisfactoriamente";
	}else{echo "Error al subir el archivo";}
}else{echo $msg;}

if ($nombre != null){
	$pdo = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');

	$sentencia = $pdo->prepare("UPDATE cuenta SET nombre=? WHERE usuario=?");
	$sentencia->execute([$nombre, $usuario]);
}

header('Location: modificar.php');
?>