<?php
$sesion = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if ($sesion != null){
	header('Location: perfil.php');
}
?>
<html>
<head>
	<style>
		#centrar {margin-top: 20%;}
		.boton {
		    -moz-box-shadow: 0px 1px 0px 0px #f0f7fa;
		    -webkit-box-shadow: 0px 1px 0px 0px #f0f7fa;
		    box-shadow: 0px 1px 0px 0px #f0f7fa;
		    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ed39e7), color-stop(1, #b31288));
		    background:-moz-linear-gradient(top, #ed39e7 5%, #b31288 100%);
		    background:-webkit-linear-gradient(top, #ed39e7 5%, #b31288 100%);
		    background:-o-linear-gradient(top, #ed39e7 5%, #b31288 100%);
		    background:-ms-linear-gradient(top, #ed39e7 5%, #b31288 100%);
		    background:linear-gradient(to bottom, #ed39e7 5%, #b31288 100%);
		    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ed39e7', endColorstr='#b31288',GradientType=0);
		    background-color:#ed39e7;
		    -moz-border-radius:6px;
		    -webkit-border-radius:6px;
		    border-radius:6px;
		    border:1px solid #78008a;
		    display:inline-block;
		    cursor:pointer;
		    color:#ffffff;
		    font-family:Arial;
		    font-size:15px;
		    font-weight:bold;
		    padding:6px 24px;
		    text-decoration:none;
		    text-shadow:0px -1px 0px #5b6178;
		  }
		  .boton:hover {
		    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #b31288), color-stop(1, #ed39e7));
		    background:-moz-linear-gradient(top, #b31288 5%, #ed39e7 100%);
		    background:-webkit-linear-gradient(top, #b31288 5%, #ed39e7 100%);
		    background:-o-linear-gradient(top, #b31288 5%, #ed39e7 100%);
		    background:-ms-linear-gradient(top, #b31288 5%, #ed39e7 100%);
		    background:linear-gradient(to bottom, #b31288 5%, #ed39e7 100%);
		    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b31288', endColorstr='#ed39e7',GradientType=0);
		    background-color:#b31288;
		  }
		  .boton:active {
		    position:relative;
		    top:1px;
		  }
	</style>
		<form method="post" action="enviar.php" enctype="multipart/form-data">
			<h1>Registro</h1><hr>
			<table>
				<tr>
					<td>Usuario: </td><td><input type="text" style="border: 2px solid #990000;" name="usuario" required></td>
				</tr><tr>
					<td>Nombre completo: </td><td><input type="text" style="border: 2px solid #990000;" name="nombre" required></td>
				</tr><tr>
					<td>Contraseña: </td><td><input type="password" style="border: 2px solid #990000;" name="clave" required></td>
				</tr><tr>	
					<td>Foto de perfil: </td><td><input type="file" name="foto" required/></td>
				</tr><tr>
					<td><input type="submit" class="boton" value="Crear"></td><td></td>
				</tr>
			</table>
		</form>