<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<?php
include("connect.php");
include("online.php");
session_start();
usuarios_activos(); 
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
    img {width: 200px; height: 200px; border-radius: 100px; border: 3px solid black;}
    .input {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
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
      <li class="nav-item">
        <a class="nav-link" href="perfil.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="difusion.php">Difundir mensaje</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="modificar.php">Modificar perfil<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href='logout.php'>Cerrar Sesi&oacute;n</a>
    </span>
  </div>
</nav>
<p/>
<?php
$datos = $pdo->query("SELECT * FROM cuenta WHERE usuario = '" . $_SESSION['username'] . "'");

while ($row = $datos->fetch()) {
    $usuario = $row['usuario'];
    $nombre = $row['nombre'];
    $perfil = $row['ruta_foto'];
}
$imagen = "<img src='" . $perfil . "'>";
?>
<div class="container">
  <form method="post" action="cambiar.php" enctype="multipart/form-data">
  <div align="center" style="background-color: #1D9BD6; border-radius: 20px;">
    <h2>Modificar perfil</h2><hr>
    <input type="file" class="input" name="foto" id="foto">
    <label for="foto"><?php echo $imagen ?></label>
    <h4>Nombre:</h4><h5 style="color: #6209B5"><?php echo $nombre ?></h5>
    <input type="text" style="border: 2px solid #990000;" name="nombre" placeholder="Nuevo nombre">
        <td><input type="submit" class="boton" value="Modificar"></td>
  </div>
  </form>
</div>