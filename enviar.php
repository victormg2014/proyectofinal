<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
if ($usuario == null){
	header('Location: index.php');
}
?>
<html>
<head>
	<style>
		body {background-color: coral;}
	</style>
</head>
<body>
<?php
include("connect.php");

$tabla = "cuenta";
$hash = password_hash($_POST['clave'], PASSWORD_DEFAULT);

if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$comprobar = "SELECT * FROM $tabla WHERE usuario = '$_POST[usuario]'";
$result = $conexion->query($comprobar);
$count = mysqli_num_rows($result);

if ($count == 1) {
	echo "<div align='center'/>El nombre de usuario ya est&aacute; en uso.<br/>";
	echo "<a href='registro.php'>Por favor escoga otro nombre</a></div>";
}
else{
	$query = "INSERT INTO cuenta (usuario, nombre, clave) VALUES ('$usuario', '$nombre' ,'$hash')";
	if ($conexion->query($query) === TRUE) {
		echo "<div align='center'/><h2>Usuario creado con exito</h2><br/>";
		echo "Bienvenido: " . $usuario . "<br/>";
		echo "Volver a la p&aacute;gina principal: <a href='index.php'>Login</a>"; 
	}
	else {
		echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
	}
}
 mysqli_close($conexion);
?>
</body>
</html>