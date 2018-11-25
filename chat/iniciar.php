<?php
include("../connect.php");
session_start();
$destino = isset($_POST['destino']) ? $_POST['destino'] : '';
if ($destino != null){
$_SESSION['destino'] = $destino;
}
header('Location: ../chat.php');
?>
