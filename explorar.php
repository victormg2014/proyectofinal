<html>
<head>
	<style>
		body {background-color: coral;}
		img {width: 200px; height: 200px;}
	</style>
</head>
<body>
<form method="get">
	Buscar: <input type="text" name="nombre">
	<input type="submit">
</form>
<?php
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
include("connect.php");
session_start();

if ($usuario != null){
	echo "Estas viendo el perfil del usuario: " . $usuario;
}

echo '<form method="post" action="perfil.php">
	<input type="submit" value="volver">
</form>';
$consulta = "SELECT usuario FROM cuenta";
if ($resultado = $conexion->query($consulta)) {
	echo "<table>";
   	while ($fila = $resultado->fetch_row()) {
   		printf ("<tr><td>" . $fila[0] . "</td></tr>");
   	}
   	$resultado->close();
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