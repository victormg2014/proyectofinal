<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

function formatearFecha($fecha){
	return date('d/m/Y - H:i', strtotime($fecha));
}
function comentarioFecha($fecha){
	return date('d/m/Y - H:i', strtotime($fecha));
}
?>
