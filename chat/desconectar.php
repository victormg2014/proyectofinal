<?php
session_start();
unset($_SESSION['destino']);
header('Location: ../chat.php');
?>