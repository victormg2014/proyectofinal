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
<div align="center" style="background-color: #1D9BD6; border-radius: 20px; padding-bottom: 20px;">
<form enctype="multipart/form-data" action="subir.php" method="POST">
  <h2>Subir una publicaci&oacute;n</h2><hr>
  <p><h4>Seleccione el contenido: </h4><input name="subir" class="boton" type="file" required/>
  <hr width="200px">
  <h4>Seleccione el t&iacute;tulo: </h4><input name="contenido" style="border: 2px solid #990000;" placeholder="T&iacute;tulo" required/>
  <hr width="200px">
  <h4>Formato del archivo:</h4>
  <input type="radio" name="formato" value="imagen" required><strong>Imagen</strong>
  <input type="radio" name="formato" value="audio" required><strong>Audio</strong>
  <input type="radio" name="formato" value="video" required><strong>Video</strong><br/>
  <hr width="200px">
  <input type="submit" class="boton" value="Subir archivo" />
</form>
</div>