<?php
session_start();
include "connect.php";
$difundir = isset($_POST['difundir']) ? $_POST['difundir'] : '';
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
$nombre = $_SESSION['username'];
for ($i=0;$i<count($difundir);$i++)    
{   
	$algoritmo = MCRYPT_BLOWFISH;
	$modo = MCRYPT_MODE_CBC;
	$key = $nombre . '|' . $difundir[$i];
	$destino = $difundir[$i];
	$vector = 12121212;

	$datos_encriptados = mcrypt_encrypt($algoritmo, $key, $mensaje, $modo, $vector);
	$texto = base64_encode($datos_encriptados);

	$sentencia = $pdo->prepare("INSERT INTO chat (usuario, destino, mensaje) VALUES (?, ?, ?)");
	$sentencia->bindParam(1, $nombre);
	$sentencia->bindParam(2, $destino);
	$sentencia->bindParam(3, $texto);
	$sentencia->execute();
}
header('Location: difusion.php');
?>
