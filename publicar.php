<?php
include("connect.php");
include("online.php");
session_start();

$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
if ($_SESSION['username'] == null){
  header('Location: index.php');
}
?>
<html>
<head>
  <meta http-equiv="refresh" content="30">
  <link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chat/style.css">
  <script src="img/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <style>
    body {background-color: coral;}
    img {width: 200px; height: 200px;}
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Bienvenido: <?php echo $_SESSION['username'] ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="perfil.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modificar.php">Modificar perfil</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href='logout.php'>Cerrar Sesi&oacute;n</a>
    </span>
  </div>
</nav>
<p/>
<div align="center">
<form enctype="multipart/form-data" action="subir.php" method="POST">
  <h2>Subir una publicaci&oacute;n</h2>
  <p><h4>Seleccione el contenido: </h4><input name="subir" type="file" required/><p/>
  <h4>Seleccione el t&iacute;tulo: </h4><input name="contenido" placeholder="T&iacute;tulo" required/><p/>
  <h4>Formato del archivo:</h4>
  <input type="radio" name="formato" value="imagen" required> Imagen
  <input type="radio" name="formato" value="audio" required> Audio
  <input type="radio" name="formato" value="video" required> Video<br/>
  <input type="submit" value="Subir archivo" />
</form>
</div>