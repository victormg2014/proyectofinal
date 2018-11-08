<html>
<head>
	<style>
		body {background-color: coral;}
		img {width: 200px; height: 200px;}
	</style>
</head>
<body>
<?php

include("connect.php");
session_start();

echo '<form method="post" action="perfil.php"><input type="submit" value="Volver"></form>';
$consulta = "SELECT usuario2 FROM amigos WHERE usuario = '" . $_SESSION['username'] . "'";
if ($resultado = $conexion->query($consulta)) {
	echo "<table>";
   	while ($fila = $resultado->fetch_row()) {
   		printf ("<tr><td>" . $fila[0] . "</td><td><form method='get'><input type='hidden' name='nombre' value='$fila[0]'><input type='submit' value='Ver perfil'></form></td></tr>");
   	}
   	$resultado->close();
}
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
if ($usuario != null){
	echo "Estas viendo el perfil del usuario: " . $usuario;
}

$query = "SELECT ruta FROM publicaciones WHERE usuario = '" . $usuario . "'";
if ($resultado = $conexion->query($query)) {
	echo "<table><tr>";
	$x = 0;
	while ($fila = $resultado->fetch_row()) {
    	printf ("<td><img src='" . $fila[0] . "'/></td>");
    	$x = $x + 1;
    	if ($x == 4){
    		echo "<tr></tr>";
    		$x = 0;
    	}
	}
	echo "</tr></table>";
   	$resultado->close();
}
?>

</body>
</html>