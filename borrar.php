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
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$query = "DELETE FROM amigos WHERE usuario = '" . $_SESSION['username'] . "' AND usuario2 = '$usuario'";
$query2 = "DELETE FROM amigos WHERE usuario = '$usuario' AND usuario2 = '" . $_SESSION['username'] . "'";
$conexion->query($query);
$conexion->query($query2);
header('Location: perfil.php');
?>
