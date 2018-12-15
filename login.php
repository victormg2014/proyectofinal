<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="chat/style.css">
<?php
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
if ($usuario == null){
  header('Location: index.php');
}
include("connect.php");

$tabla = "cuenta";

if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$sql = "SELECT * FROM $tabla WHERE usuario = '$usuario'";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {     
	}
 	$row = $result->fetch_array(MYSQLI_ASSOC);
 	if (password_verify ($clave, $row['clave'])) { 
 		session_start();
    	$_SESSION['loggedin'] = true;
    	$_SESSION['username'] = $usuario;
    	$_SESSION['start'] = time();
    	$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    	header('Location: perfil.php');

 	} else { 
   		echo "<div align='center'>Usuario o contrase&ntilde;a incorrectos.<br/>";
   		echo "<br><a href='index.php'>Volver a Intentarlo</a></div>";
 	}
 mysqli_close($conexion); 
 ?>