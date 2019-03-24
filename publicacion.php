<?php
include("connect.php");
session_start();
$usuario = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$comentario = isset($_GET['comentario']) ? $_GET['comentario'] : '';
if ($comentario != null){
  header('Location: publicacion.php');
}
?>
<html>
<head>
  <meta http-equiv="refresh" content="30">
	<link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
	<style>
		img {width: 400px; height: 400px;}
    video {width: 400px; height: 400px;}
    audio {width: 400px; height: 400px;}
	</style>
  <link rel="stylesheet" type="text/css" href="chat/style.css">
  <script src="img/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
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
<div class="container">
  <div class="row">
      <div class="col-md-6">
      <?php
      $visualizar = isset($_GET['visualizar']) ? $_GET['visualizar'] : '';
      if ($visualizar != null){
        $_SESSION['comentario'] = $visualizar;
        header('Location: publicacion.php');
      }
      $query = "SELECT ruta, contenido, formato FROM publicaciones WHERE id = '" . $visualizar . "'";
      if ($resultado = $conexion->query($query)) {
        while ($fila = $resultado->fetch_row()) {  
          $_SESSION['ruta'] = $fila[0];
          $_SESSION['contenido'] = $fila[1];
          $_SESSION['formato'] = $fila[2];
          ?>
          <?php
        }
      }
      ?>
      <h2>Publicaci&oacute;n</h2>
      <?php
      if ($_SESSION['formato'] == 'imagen'){
      ?>
      <img src= <?php echo $_SESSION['ruta'] ?>><p/>
      <?php
      } elseif ($_SESSION['formato'] == 'video'){
      ?>
      <video src= <?php echo $_SESSION['ruta'] ?> controls></video><p/>
      <?php
      } elseif ($_SESSION['formato'] == 'audio'){
      ?>
      <audio src= <?php echo $_SESSION['ruta'] ?> controls></audio><p/>
      <?php
      } ?>
      <h5><?php echo $_SESSION['contenido'] ?></h5>
      </div>
      <div class="col-md-6">
  <h2>Comentarios</h2>
  <form method='get'><input type="text" name="comentario"><input type="submit" value="Publicar"></form>
  <?php
  
  if ($_SESSION['comentario'] != null && $comentario != null) {
    $query = "INSERT INTO comentarios (id_publicacion, texto, usuario) VALUES ('" . $_SESSION['comentario'] . "', '$comentario', '" . $_SESSION['username'] . "')";
    if ($conexion->query($query) === TRUE) {
    }
  }
  $query = "SELECT usuario, texto, fecha FROM comentarios WHERE id_publicacion = '" . $_SESSION['comentario'] . "' ORDER BY id DESC";
  if ($resultado = $conexion->query($query)) {
    echo "<table>";
    while ($fila = $resultado->fetch_row()) {   
      echo "<tr><td>" . $fila[0] . ": " . $fila[1] . "</td><td><a style='font-size: 10px'>" . comentarioFecha($fila[2]) . "</a></td></tr>";
    }
    echo "</table>";
  }
    ?>
</div></div>