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
		#centrar {margin-top: 20%;}
	</style>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chat/style.css">
</head>
<body>
	<div align="center">
		<form method="post" action="enviar.php" enctype="multipart/form-data">
			<h1>Registro</h1>
			<table>
				<tr>
					<td>Usuario: </td><td><input type="text" name="usuario" required></td>
				</tr><tr>
					<td>Nombre completo: </td><td><input type="text" name="nombre" required></td>
				</tr><tr>
					<td>Contraseña: </td><td><input type="password" name="clave" required></td>
				</tr><tr>	
					<td>Foto de perfil: </td><td><input type="file" name="foto" required/></td>
				</tr><tr>
					<td><input type="submit" value="Crear"></td><td></td>
				</tr>
			</table>
		</form>
		<input type="submit" value="Volver" onclick = "location='index.php'"/>
	</div>
</body>
</html>