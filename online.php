<?php
function usuarios_activos()
{
  	$host_db = "localhost";
  	$user_db = "root";
  	$pass_db = "";
  	$db_name = "usuarios";

	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

   	$usuario = $_SESSION['username'];
   	$ahora = time();

   	$limite = $ahora-5*60;
   	$ssql = "delete from usuarios_online where fecha < ". $limite;
   	$conexion->query($ssql);

   	$ssql = "select usuario, fecha from usuarios_online where usuario = '$usuario'";
   	$resultado = $conexion->query($ssql);

   	if (mysqli_num_rows($resultado) != 0) {
   		$ssql = "update usuarios_online set fecha = ". $ahora ." where usuario = '$usuario'";
   	}
   	else {
   		$ssql = "insert into usuarios_online (usuario, fecha) values ('$usuario', $ahora)";
   	}
   	$conexion->query($ssql);
   	/*
   	$ssql = "select usuario from usuarios_online";
   	$resultado = $conexion->query($ssql);
   	$usuarios = mysqli_num_rows($resultado);

   	return $resultado;
   	*/
}
?>