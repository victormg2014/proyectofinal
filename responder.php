<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");
session_start();

$aceptar = isset($_POST['aceptar']) ? $_POST['aceptar'] : '';
$rechazar = isset($_POST['rechazar']) ? $_POST['rechazar'] : '';

if ($aceptar != null){
	$query = "INSERT INTO amigos (usuario, usuario2) VALUES ('" . $_SESSION['username'] . "', '$aceptar')";
	$query2 = "INSERT INTO amigos (usuario, usuario2) VALUES ('$aceptar', '" . $_SESSION['username'] . "')";
	$query3 = "DELETE FROM solicitudes WHERE destino = '" . $_SESSION['username'] . "' AND usuario = '$aceptar'";
	$conexion->query($query);
	$conexion->query($query2);
	$conexion->query($query3);
	echo "<div align='center'>Se ha aceptado la solicitud de amistad.<br/><a href='amigos.php'>Volver</a></div>";
}
if ($rechazar != null){
	$query = "DELETE FROM solicitudes WHERE destino = '" . $_SESSION['username'] . "' AND usuario = '$rechazar'";
	if ($conexion->query($query) === TRUE) {
		echo "<div align='center'>Se ha rechazado la solicitud de amistad.<br/><a href='amigos.php'>Volver</a></div>";
	}
	else {
		echo "<div align='center'>Se ha producido un error.</div>";
	}
}

?>