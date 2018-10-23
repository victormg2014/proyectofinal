<html>
<?php
include("connect.php");
session_start();
$sesion = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if ($sesion != null){
	header('Location: perfil.php');
}
if (!$conexion) {
    die("Conexi&oacute;n fallida: " . mysqli_connect_error());
}
echo "Conexi&oacute;n correcta";
mysqli_close($conexion);
?>
<head>
	<style>
		body {background-color: coral;}
		#centrar {margin-top: 20%;}
	</style>
</head>
<body>
	<div align="center">
		<form method="post" action="login.php">
			<h1>Acceso</h1>
			<table>
				<tr>
					<td>Usuario: </td><td><input type="text" name="usuario" required></td>
				</tr><tr>
					<td>Contraseña: </td><td><input type="password" name="clave" required></td>
				</tr><tr>	
					<td><input type="submit" value="Acceder"></td><td></td>
				</tr>
			</table>
		</form>
		<input type="submit" value="Registro" onclick = "location='registro.php'"/>
	</div>
</body>
</html>