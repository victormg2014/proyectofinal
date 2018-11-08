<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}