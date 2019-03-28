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
    audio {width: 400px; height: 100px;}
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
        <a class="nav-link" href="difusion.php">Difundir mensaje</a>
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
      <div class="col-md-6" style="background-color: orange; border-radius: 20px; padding-bottom: 20px;">
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
      <h2 style="text-align: center;">Publicaci&oacute;n</h2><hr>
      <div align="center">
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
      </div>
      <div class="col-md-6" style="background-color: #1D9BD6; border-radius: 20px;">
  <h2 style="text-align: center;">Comentarios</h2><hr>
  <form method='get'><input type="text" style="border: 2px solid #990000;" name="comentario" placeholder="Tu comentario"> <input type="submit" class="boton" value="Publicar"></form>
  <?php
  if ($_SESSION['comentario'] != null && $comentario != null) {
    $query = "INSERT INTO comentarios (id_publicacion, texto, usuario) VALUES ('" . $_SESSION['comentario'] . "', '$comentario', '" . $_SESSION['username'] . "')";
    if ($conexion->query($query) === TRUE) {
    }
  }
  $query = "SELECT usuario, texto, fecha FROM comentarios WHERE id_publicacion = '" . $_SESSION['comentario'] . "' ORDER BY id DESC";
  if ($resultado = $conexion->query($query)) {
    while ($fila = $resultado->fetch_row()) {   
      ?>
      <div class="d-flex bd-highlight">
      <div class="img_cont">
      <?php
      $sentencia = $pdo->query("SELECT ruta_foto FROM cuenta WHERE usuario = '$fila[0]'");
      $datos = $sentencia->fetch();
      $mostrar = $datos['ruta_foto'];
      echo "<img src='$mostrar' class='rounded-circle user_img'></div><div class='user_info'>";
      echo "<span>" . $fila[0] . "</span><p>" . comentarioFecha($fila[2]) . "</p></div><div class='user_info'>";
      echo "<strong>" . $fila[1] . "</a></strong>";
      echo "</div></div>";
    }
  }
    ?>
</div></div>