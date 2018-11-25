<?php
include("connect.php");
session_start();
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$query = "DELETE FROM solicitudes WHERE usuario = '" . $_SESSION['username'] . "' AND destino = '$nombre'";
$conexion->query($query);
header('Location: perfil.php');
?>