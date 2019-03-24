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
mysqli_close($conexion);
?>
<head>
	<style>
		body {background-color: coral;}
		#centrar {margin-top: 20%;}
	</style>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="chat/style.css">
</head>
<body>
	<div class="container">
  		<div class="row">
  			<div class="col-md-4">
				<img src="img/logo.png">
			</div>
			<div class="col-md-4">
				<form method="post" action="ldap.php">
					<h1>Acceso mediante LDAP</h1>
					<br/>
					Si dispones de una cuenta LDAP, inicia sesi&oacute;n aqu&iacute;:
					<p/><p/>
					<table>
						<tr>
							<td><b>Usuario: </b></td><td><input type="text" name="usuario" required></td>
						</tr><tr>
							<td><b>Contrase&ntilde;a: </b></td><td><input type="password" name="clave" required></td>
						</tr><tr>	
							<td><input type="submit" value="Acceder"></td><td></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-md-4">
				<h1>Registrate</h1>
				<br/>
				Si a&uacute;n no dispones de una cuenta, crea una nueva haciendo clic aqu&iacute;:
				<br/>
				<input type="submit" value="Registro" onclick = "location='registro.php'"/>
			</div>
		</div>
	</div>
	<div align="center">
		<form method="post" action="index.php">
			<input type="submit" value="Volver">
		</form>
	</div>
</body>
</html>