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
		#login {height: 80px; margin-top: 10px; background-color: #3BB5E7; border-radius: 20px; width: 100%; padding: 20px;}
	</style>
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="chat/style.css">
</head>
<body>
	<div class="container">
  		<div class="row">
  			<div align="right" id="login">
  				<form method="post" action="ldap.php">
  				<input type="text" name="usuario" placeholder="Usuario" required>
  				<input type="password" name="clave" placeholder="Contrase&ntilde;a" required>
  				<input type="submit" class="boton" value="Conectar">
  				</form>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-6" style="background-color: #531CF0; border-radius: 20px; padding: 20px;">
  				<div align="center">
					<img src="img/logo.png">
				</div>
			</div>
			<div class="col-md-6" style="background-color: #1D9BD6; border-radius: 20px;">
			<?php include("registro.php"); ?>
		</div>
		</div>
	</div>
</body>
</html>