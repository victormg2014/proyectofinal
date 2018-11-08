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

$destino = isset($_SESSION['destino']) ? $_SESSION['destino'] : '';
if ($destino != null){
	header('Location: chat/chat.php');
}
$query = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
$result = $conexion->query($query);
$count = mysqli_num_rows($result);
if ($count != null) {
	if ($resultado = $conexion->query($query)) {
		echo "<table><tr>Lista de amigos:</tr>";
		while ($fila = $resultado->fetch_row()) {
	    	printf ("<tr><td>" . $fila[0] . "</td><td><form method='post' action='borrar.php'><input type='hidden' name='usuario' value='" . $fila[0] . "'><input type='submit' value='Borrar'></form></td><td><form method='post' action='chat/chat.php'><input type='hidden' name='destino' value='" . $fila[0] . "'><input type='submit' value='Chatear'></form></td></tr>");
		}
		echo "</table>";
	   	$resultado->close();
	}
}

?>
<form method='post' action='perfil.php'><input type='submit' value='Volver'></form>