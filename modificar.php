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
      <li class="nav-item">
        <a class="nav-link" href="perfil.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chat.php">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="explorar.php">Perfiles</a>
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
$pdo = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');
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
  <div align="center">
    <h2>Modificar perfil</h2>
    <h4>Usuario: <a style="color:#6209B5"><?php echo $usuario ?></a></h4>
    <table>
      <tr>
        <td><h4>Foto:</h4></td><td><?php echo $imagen ?></td><td><input type="file" name="foto"></td>
      </tr>
      <tr>
        <td><h4>Nombre:</h4></td><td><h5 style="color: #6209B5"><?php echo $nombre ?></h5></td><td><input type="text" name="nombre" placeholder="Nuevo nombre"></td>
      </tr>
      <tr>
        <td><input type="submit" value="Modificar"></td>
      </tr>
    </table>
  </div>
  </form>
</div>