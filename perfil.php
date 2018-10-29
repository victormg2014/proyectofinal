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
echo "<div align='center'>";
echo "Bienvenido: " . $_SESSION['username'] . "<br/>";
echo "<a href='logout.php'>Cerrar Sesión</a>";
echo "</div>";
?>
<table>
	<tr>
		<td>
			<form enctype="multipart/form-data" action="subir.php" method="POST">
			<input name="subir" type="file" />
			<input type="submit" value="Subir archivo" />
			</form>
		</td>
	</tr>
	<tr>
	</tr>
</table>
<?php

$query = "SELECT ruta FROM publicaciones WHERE usuario = '" . $_SESSION['username'] . "'";
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