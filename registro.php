<?php
session_start();
$sesion = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if ($sesion != null){
	header('Location: perfil.php');
}
?>
<html>
<head>
	<style>
		body {background-color: coral;}
		#centrar {margin-top: 20%;}
	</style>
</head>
<body>
	<div align="center">
		<form method="post" action="enviar.php">
			<h1>Registro</h1>
			<table>
				<tr>
					<td>Usuario: </td><td><input type="text" name="usuario" required></td>
				</tr><tr>
					<td>Nombre completo: </td><td><input type="text" name="nombre" required></td>
				</tr><tr>
					<td>Contraseña: </td><td><input type="password" name="clave" required></td>
				</tr><tr>	
					<td><input type="submit" value="Acceder"></td><td></td>
				</tr>
			</table>
		</form>
		<input type="submit" value="Volver" onclick = "location='index.php'"/>
	</div>
</body>
</html>